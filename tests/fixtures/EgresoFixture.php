<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class EgresoFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\Egreso';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/egreso.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

