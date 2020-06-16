<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class UnidadMedidaFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\UnidadMedida';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/unidad_medida.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

