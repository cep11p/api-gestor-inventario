<?php

namespace app\models;

use Yii;
use \app\models\base\Categoria as BaseCategoria;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "categoria".
 */
class Categoria extends BaseCategoria
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
}
