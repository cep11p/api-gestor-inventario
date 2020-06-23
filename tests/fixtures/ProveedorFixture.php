<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class ProveedorFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\Proveedor';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/proveedor.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

