<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class TipoEgresoFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\TipoEgreso';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/tipo_egreso.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

