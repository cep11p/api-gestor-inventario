<?php

use yii\db\Migration;

/**
 * Class m200609_165710_comprobante
 */
class m200609_165710_comprobante extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('comprobante', 'total', $this->double());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200609_165710_comprobante cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200609_165710_comprobante cannot be reverted.\n";

        return false;
    }
    */
}
