<?php

namespace app\models;

use Yii;
use \app\models\base\Comprobante as BaseComprobante;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

/**
 * This is the model class for table "comprobante".
 */
class Comprobante extends BaseComprobante
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

    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                # custom validation rules
            ]
        );
    }
    
    public function getListaProducto() {
        $inventarioSearch = new InventarioSearch();
        
        $resultado = $inventarioSearch->getListaProductoPorComprobanteid(['comprobanteid'=>$this->id]);
        
        return $resultado;
    }
    
    public function getCantidadTotalProducto() {
        $inventarioSearch = new InventarioSearch();
        
        $resultado = $inventarioSearch->getCantitadProducto(['comprobanteid'=>$this->id]);
        
        return $resultado;
    }
    
    public function setAttributesCustom($values, $safeOnly = true) {
        parent::setAttributes($values, $safeOnly);
        $this->fecha_inicial = date('Y-m-d');
    }
    
    public function borrarListaProducto() {
        Inventario::deleteAll(['comprobanteid'=>$this->id]);    
    }
   
    /**
     * Se carga una lista de productos 
     * @param array $param lista de prodcuto que ingresan al inventario
     * @throws Exception
     */
    public function setListaProducto($param) {
        
        if(!isset($param['lista_producto']) || count($param['lista_producto'])<=0){
            throw new Exception('Falta lista de productos');
        }
        
        foreach ($param['lista_producto'] as $producto) {
            if(!is_numeric($producto['cantidad']) || intval($producto['cantidad'])<=0){
                throw new Exception('La cantidad debe ser un numero y mayor a 0');
            }

            /** Guardamos un stock segun la cantidad de cada producto **/
            if(isset($producto['cantidad']) && $producto['cantidad']>0){
                for($i = 1; $i <= $producto['cantidad']; $i++ ){
                    $stock = new Inventario();
                    $stock->setAttributes($producto);
                    $stock->comprobanteid = $this->id;
                    $stock->productoid = $producto['id'];
                    if(!$stock->save()){
                        throw new Exception(json_encode($stock->getErrors()));
                    }
                }                    
            }
        }
    }
    
    /**
     * Se hace una modificacion sobre los productos que faltaban entregar. La modificacion se basa en cambiar falta = 1 (true) a falta = 0 (falso)
     * @param array $param
     * @throws Exception
     */
    public function registrarProductoPendiente($param) {
        
        if(!isset($param['falta'])){
            throw new Exception('El atributo falta es obligatorio');
        }
        
        if(!isset($param['fecha_vencimiento']) || !\app\components\Help::validateDate($param['fecha_vencimiento'], 'Y-m-d')){
            throw new Exception('La fecha es obligatoria y debe tener el formato aaaa-mm-dd');
        }

        if(!isset($param['cantidad']) || !is_numeric($param['cantidad']) || intval($param['cantidad'])<=0){
            throw new Exception('La cantidad es obligatoria y debe ser un numero y mayor a 0');
        }        
        
        $falta = \app\components\Help::setBoolean($param['falta']);
        $encontrarListaCondicion = array(
            'comprobanteid'=> $this->id,
            'productoid'=>$param['productoid'],
            'falta'=>1,
            'egresoid'=>null
        );
        $modificarListaCondicion = ['falta'=>0,'fecha_vencimiento'=>$param['fecha_vencimiento']];
        
        //chequeamos si la falta es verdadero, entonces modificaremos los productos con falta en falso
        if($falta){
            $encontrarListaCondicion['falta']=0;
            $encontrarListaCondicion['fecha_vencimiento']=$param['fecha_vencimiento'];
            $modificarListaCondicion = ['falta'=>1,'fecha_vencimiento'=>null];
        }
        $producto_encontroado_lista = Inventario::find()->where($encontrarListaCondicion)->asArray()->all();
        $ids = $this->getProductoEncontradoIds($producto_encontroado_lista, $param['cantidad']);
                           
        $resultado = Inventario::updateAll($modificarListaCondicion, ['id'=>$ids]);        
    }
    
    /**
     * Obtenemos los ids de los productos a modificar
     * @param array $producto_encontroado_lista
     * @param int $cantidad este atributo nos ayuda a validar la cantidad disponible a modificar
     * @return array
     * @throws Exception
     */
    private function getProductoEncontradoIds($producto_encontroado_lista, $cantidad) {
        //Verificamos la cantidad de productos disponibles a modificar
        if(isset($cantidad) && count($producto_encontroado_lista)<$cantidad){
            throw new Exception('La cantidad a modificar es mayor a la cantidad de productos existentes en el inventario ('. count($producto_encontroado_lista).')');
        }  

        for($i = 0; $i < $cantidad; $i++ ){
            $ids[] = $producto_encontroado_lista[$i]['id'];
        } 
        
        return $ids;
    }
    
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), [
            'producto_cant_total'=> function($model){
                return $model->cantidadTotalProducto;
            },
            'proveedorid'=> function($model){
                return ($model->proveedorid==null)?'':$model->proveedorid;
            },
            'proveedor'=> function($model){
                return ($model->proveedor==null)?'':$model->proveedor;
            }
        ]);
        
    }
}
