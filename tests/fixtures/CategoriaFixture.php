<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class CategoriaFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\Categoria';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/categoria.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

