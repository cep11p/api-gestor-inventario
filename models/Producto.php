<?php

namespace app\models;

use Yii;
use \app\models\base\Producto as BaseProducto;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "producto".
 */
class Producto extends BaseProducto
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
    
    public function fields()
    {
        return ArrayHelper::merge(parent::fields(), [
            'marca'=> function($model){
                return $model->marca->nombre;
            },
            'unidad_medida'=> function($model){
                return $model->unidadMedida->simbolo;
            },
            'producto'=> function($model){
                return $model->nombre.', '.$model->unidad_valor.$model->unidadMedida->simbolo.' ('.$model->marca->nombre.')';
            }
        ]);
        
    }
}
