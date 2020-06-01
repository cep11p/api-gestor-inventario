<?php

namespace app\models;

use Yii;
use \app\models\base\Marca as BaseMarca;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "marca".
 */
class Marca extends BaseMarca
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
