<?php

use yii\db\Migration;

/**
 * Class m200619_150926_comprobante
 */
class m200619_150926_comprobante extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('comprobante', 'fecha_incial', 'fecha_inicial');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200619_150926_comprobante cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200619_150926_comprobante cannot be reverted.\n";

        return false;
    }
    */
}
