<?php

use yii\db\Migration;

/**
 * Class m200611_163245_inventario
 */
class m200611_163245_inventario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = 'inventario';
        $this->dropColumn($table, 'inexistente');
        $this->addColumn($table, 'falta', $this->tinyInteger()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200611_163245_inventario cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200611_163245_inventario cannot be reverted.\n";

        return false;
    }
    */
}
