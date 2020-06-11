<?php

use yii\db\Migration;

/**
 * Class m200611_151142_inventario
 */
class m200611_151142_inventario extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = 'inventario';
        $this->dropPrimaryKey('comprobanteid',$table);
        $this->addColumn($table, 'id', $this->primaryKey());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200611_151142_inventario cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200611_151142_inventario cannot be reverted.\n";

        return false;
    }
    */
}
