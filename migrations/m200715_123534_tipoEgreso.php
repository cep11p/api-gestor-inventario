<?php

use yii\db\Migration;

/**
 * Class m200715_123534_tipoEgreso
 */
class m200715_123534_tipoEgreso extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = 'egreso';
        $this->createTable('tipo_egreso', ['id'=>$this->primaryKey(), 'nombre'=>$this->string(40)]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200715_123534_tipoEgreso cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200715_123534_tipoEgreso cannot be reverted.\n";

        return false;
    }
    */
}
