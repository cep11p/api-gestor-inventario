<?php

namespace app\models;

use Yii;
use \app\models\base\Egreso as BaseEgreso;
use yii\helpers\ArrayHelper;

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
    
    /**
     * Se obtienen lista de producto de un egreso
     * @return array
     */
    public function getListaProducto() {
        $inventarioSearch = new InventarioSearch();
        $lista_producto = $inventarioSearch->getListaProductoPorEgresoId(['egresoid'=>$this->id]);
        return $lista_producto;
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
