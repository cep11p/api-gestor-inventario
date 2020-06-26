<?php

use yii\db\Migration;

/**
 * Class m200626_133414_egreso
 */
class m200626_133414_egreso extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = "egreso";
        $this->addColumn($table, "nro_acta", $this->string(20));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200626_133414_egreso cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200626_133414_egreso cannot be reverted.\n";

        return false;
    }
    */
}
