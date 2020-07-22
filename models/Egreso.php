<?php

namespace app\models;

use Yii;
use \app\models\base\Egreso as BaseEgreso;
use yii\helpers\ArrayHelper;
use yii\base\Exception;
/**
 * This is the model class for table "egreso".
 */
class Egreso extends BaseEgreso
{

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }
    
    public function setAttributesCustom($values, $safeOnly = true) {
        parent::setAttributes($values, $safeOnly);
        $this->fecha_inicial = date('Y-m-d');
    }
    
    public function getLocalidad() {
        
        $resultado = null;

        $response = \Yii::$app->lugar->buscarLocalidadPorId($this->destino_localidadid);   
        /** Chequeamos si existe el nombre de la localidad **/
        if(isset($response['nombre']) && !empty($response['nombre'])){
            $resultado = $response['nombre'];
        }
        
        return $resultado;
    }
    
    /**
     * Se obtienen lista de producto de un egreso
     * @return array
     */
    public function getListaProducto() {
        $inventarioSearch = new InventarioSearch();
        $lista_producto = $inventarioSearch->getListaProductoPorEgresoId(['egresoid'=>$this->id]);
        return $lista_producto;
    }
    
    /**
     * Se crea la lista de los productos que egresan
     * @param array $param
     * @return int cantidad egresados
     * @throws Exception
     */
    public function setListaProducto($param) {        
        if(!isset($param['lista_producto']) || count($param['lista_producto'])<1){
            throw new Exception('Lista de producto vacia.');
        }
        
        $ids = array();
        foreach ($param['lista_producto'] as $value) {
            if(!isset($value['id'])){
                throw new Exception('Falta id de la lista de productos');
            }
            $ids[] = $value['id']; 
        }
        
        //Chequeamos si algunos de los productos a egresar estan en falta(falta de entrega por parte del proveedor)
        $cant_producto = Inventario::find()->where(['in', 'id', $ids])->andWhere(['egresoid'=>null,'falta'=>1])->count();
        if($cant_producto>0){
            throw new Exception('Unos de los productos falta ser entregado por el proveedor');
        }
        
        //Chequeamos si es posible egresar todos los productos de la lista
        $cant_egresados = Inventario::find()->where(['in', 'id', $ids])->andWhere(['egresoid'=>null])->count();
        if($cant_egresados <> count($param['lista_producto'])){
            throw new Exception('Algunos de los productos ya fueron egresados');
        }
        
        $resultado = Inventario::updateAll(['egresoid' => $this->id], ['id'=>$ids]);

        return $resultado;
    }

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
    
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), [
            'tipo_egreso'=> function($model){
                return $model->tipoEgreso->nombre;
            },
            'producto_cant_total'=> function($model){
                return count($model->listaProducto);
            }
        ]);
        
    }
}
