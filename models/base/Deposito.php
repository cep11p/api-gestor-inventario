<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "deposito".
 *
 * @property integer $id
 * @property string $nombre
 * @property integer $lugarid
 *
 * @property \app\models\Inventario[] $inventarios
 * @property string $aliasModel
 */
abstract class Deposito extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'deposito';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['lugarid'], 'integer'],
            [['nombre'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'lugarid' => 'Lugarid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(\app\models\Inventario::className(), ['depositoid' => 'id']);
    }




}