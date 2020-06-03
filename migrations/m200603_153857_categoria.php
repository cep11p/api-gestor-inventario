<?php

use yii\db\Migration;

/**
 * Class m200603_153857_categoria
 */
class m200603_153857_categoria extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('categoria', 'nombre', $this->string(100)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200603_153857_categoria cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200603_153857_categoria cannot be reverted.\n";

        return false;
    }
    */
}
