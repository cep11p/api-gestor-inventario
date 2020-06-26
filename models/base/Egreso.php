<?php
// This class was automatically generated by a giiant build task
// You should not change it manually as it will be overwritten on next build

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "egreso".
 *
 * @property integer $id
 * @property string $fecha
 * @property string $origen
 * @property string $destino_nombre
 * @property integer $destino_localidadid
 * @property string $descripcion
 * @property string $nro_acta
 *
 * @property \app\models\Inventario[] $inventarios
 * @property string $aliasModel
 */
abstract class Egreso extends \yii\db\ActiveRecord
{



    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'egreso';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'fecha', 'destino_nombre', 'destino_localidadid'], 'required'],
            [['id', 'destino_localidadid'], 'integer'],
            [['fecha'], 'safe'],
            [['descripcion'], 'string'],
            [['origen', 'destino_nombre'], 'string', 'max' => 100],
            [['nro_acta'], 'string', 'max' => 20],
            [['id'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha' => 'Fecha',
            'origen' => 'Origen',
            'destino_nombre' => 'Destino Nombre',
            'destino_localidadid' => 'Destino Localidadid',
            'descripcion' => 'Descripcion',
            'nro_acta' => 'Nro Acta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInventarios()
    {
        return $this->hasMany(\app\models\Inventario::className(), ['egresoid' => 'id']);
    }




}
