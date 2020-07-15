<?php

namespace app\models;

use Yii;
use \app\models\base\TipoEgreso as BaseTipoEgreso;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tipo_egreso".
 */
class TipoEgreso extends BaseTipoEgreso
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
