<?php

namespace app\models;

use Yii;
use \app\models\base\Proveedor as BaseProveedor;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "proveedor".
 */
class Proveedor extends BaseProveedor
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
