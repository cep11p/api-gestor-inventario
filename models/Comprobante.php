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
    
    /**
     * Se registran los productos que faltaron, realizando una modificacion sobre los productos que ingresaron. 
     * Se modifican los productos falta=0 a falta=1
     * @param array $param
     * @throws Exception
     */    
    public function registrarProductoFaltante($param) {
        
        if(!isset($param['fecha_vencimiento']) || !\app\components\Help::validateDate($param['fecha_vencimiento'], 'Y-m-d')){
            throw new Exception('La fecha es obligatoria y debe tener el formato aaaa-mm-dd');
        }

        if(!isset($param['cantidad']) || !is_numeric($param['cantidad']) || intval($param['cantidad'])<=0){
            throw new Exception('La cantidad es obligatoria y debe ser un numero y mayor a 0');
        }        
        
        $condicion = [
            'comprobanteid'=> $this->id,
            'productoid'=>$param['productoid'],
            'fecha_vencimiento'=>$param['fecha_vencimiento'],
            'falta'=>0
        ];
        $producto_encontroado_lista = Inventario::find()->where($condicion)->asArray()->all();
        
        //Verificamos la cantidad de productos disponibles a modificar
        if(isset($param['cantidad']) && count($producto_encontroado_lista)<$param['cantidad']){
            throw new Exception('La cantidad a modificar es mayor a la cantidad del producto que existe en el inventario ('. count($producto_encontroado_lista).')');
        }  
        

        for($i = 0; $i < $param['cantidad']; $i++ ){
            $condition[] = $producto_encontroado_lista[$i]['id'];
        }                    
        
        $resultado = Inventario::updateAll(['falta'=>1,'fecha_vencimiento'=>null], ['id'=>$condition]);        
    }
    
    public function registrarProductoPendiente($param) {
        
        if(!isset($param['fecha_vencimiento']) || !\app\components\Help::validateDate($param['fecha_vencimiento'], 'Y-m-d')){
            throw new Exception('La fecha es obligatoria y debe tener el formato aaaa-mm-dd');
        }

        if(!isset($param['cantidad']) || !is_numeric($param['cantidad']) || intval($param['cantidad'])<=0){
            throw new Exception('La cantidad es obligatoria y debe ser un numero y mayor a 0');
        }        
        
        $condicion = [
            'comprobanteid'=> $this->id,
            'productoid'=>$param['productoid'],
            'falta'=>1
        ];
        $producto_encontroado_lista = Inventario::find()->where($condicion)->asArray()->all();
        
        //Verificamos la cantidad de productos disponibles a modificar
        if(isset($param['cantidad']) && count($producto_encontroado_lista)<$param['cantidad']){
            throw new Exception('La cantidad a modificar es mayor a la cantidad de productos existentes en el inventario ('. count($producto_encontroado_lista).')');
        }  
        

        for($i = 0; $i < $param['cantidad']; $i++ ){
            $condition[] = $producto_encontroado_lista[$i]['id'];
        }                    
        
        $resultado = Inventario::updateAll(['falta'=>0,'fecha_vencimiento'=>$param['fecha_vencimiento']], ['id'=>$condition]);        
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
