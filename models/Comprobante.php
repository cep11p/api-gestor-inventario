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
    
    public function getProductos() {
        $inventarioSearch = new InventarioSearch();
        
        $resultado = $inventarioSearch->obtenerProductosPorComprobanteid($this->id);
        
        return $resultado;
    }
    
    public function setAttributesCustom($values, $safeOnly = true) {
        parent::setAttributes($values, $safeOnly);
        $this->fecha_incial = date('Y-m-d');
    }
}
