<?php

use yii\db\Migration;

/**
 * Class m200717_131116_egreso_id_autoincrement
 */
class m200717_131116_egreso_id_autoincrement extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = 'egreso';
        $this->dropForeignKey('fk_stock_egreso1', 'inventario');
        $this->dropColumn($table, 'id');
        $this->addColumn($table, 'id', $this->primaryKey());
        $this->addForeignKey('fk_egresoid', 'inventario', 'egresoid', 'egreso', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200717_131116_egreso_id_autoincrement cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200717_131116_egreso_id_autoincrement cannot be reverted.\n";

        return false;
    }
    */
}
