<?php

use yii\db\Migration;

/**
 * Class m200724_130248_producto_activo
 */
class m200724_130248_producto_activo extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = 'producto';
        $this->addColumn($table, 'activo', $this->tinyInteger(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200724_130248_producto_activo cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200724_130248_producto_activo cannot be reverted.\n";

        return false;
    }
    */
}
