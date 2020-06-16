<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class InventarioFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\Inventario';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/inventario.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

