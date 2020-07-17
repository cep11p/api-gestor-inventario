<?php

use yii\db\Migration;

/**
 * Class m200717_123548_egreso_fecha_inicial
 */
class m200717_123548_egreso_fecha_inicial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = 'egreso';
        $this->addColumn($table, 'fecha_inicial', $this->date()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200717_123548_egreso_fecha_inicial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200717_123548_egreso_fecha_inicial cannot be reverted.\n";

        return false;
    }
    */
}
