<?php

namespace app\models;

use Yii;
use \app\models\base\Comprobante as BaseComprobante;
use yii\helpers\ArrayHelper;

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
        
        $resultado = $inventarioSearch->getListaProducto(['comprobanteid'=>$this->id]);
        
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
    
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), [
            'producto_cant_total'=> function($model){
                return $model->cantidadTotalProducto;
            },
            'proveedorid'=> function($model){
                return ($model->proveedorid==null)?'':$model->proveedorid;
            },
            'proveedor'
        ]);
        
    }
}
