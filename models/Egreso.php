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