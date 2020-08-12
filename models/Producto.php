<?php

namespace app\models;

use Yii;
use \app\models\base\Producto as BaseProducto;
use yii\helpers\ArrayHelper;
use yii\base\Exception;

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
    
    /**
     * Seteamos el atributo activo de un producto
     * @param array $param
     * @return boolean
     * @throws Exception
     */
    public function setActivo($param) {
        $activo = false;
        if(isset($param['activo'])){
            $activo = \app\components\Help::setBoolean($param['activo']);        
        }
        
        $this->activo = \app\components\Help::booleanToInt($activo);
        
        if(!$this->save()){
            throw new Exception(json_encode($this->getErrors()));
        }
        
        return true;
    }
    
    public function generarCodigo($longitud) {
        $key = '';
        $pattern = '1234567890';
        $max = strlen($pattern)-1;
        for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
        return $key;
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
            },
            'categoria'=> function($model){
                return $model->categoria->nombre;
            }
        ]);
        
    }
}
