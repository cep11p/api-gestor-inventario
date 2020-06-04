<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class MarcaFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\Marca';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/marca.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

