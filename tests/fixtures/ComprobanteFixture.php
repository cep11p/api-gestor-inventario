<?php

namespace app\tests\fixtures;
use yii\test\ActiveFixture;

class ComprobanteFixture extends ActiveFixture{
    
    public $modelClass = '\app\models\Comprobante';
    
    public function init() {
        $this ->dataFile = \Yii::getAlias('@app').'/tests/_data/comprobante.php';
        parent::init();
    }
    
    public function unload()
    {
        parent::unload();
        $this->resetTable();
    }
    
}

