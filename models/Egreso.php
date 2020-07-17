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
        if(count($param['lista_producto'])<1){
            throw new Exception('Lista de producto está vacia.');
        }
        
        $ids = array();
        foreach ($param['lista_producto'] as $value) {
            if(!isset($value['id'])){
                throw new Exception('Falta id de la lista de productos');
            }
            $ids[] = $value['id']; 
        }
        
        $cant_producto = Inventario::find()->where(['in', 'id', $ids])->andWhere(['not',['egresoid'=>null]])->count();
        
        if($cant_producto!=0){
            throw new Exception('Los productos ya fueron egresados');
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
