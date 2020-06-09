<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class ProductoFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\Producto';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/producto.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

