<?php

use yii\db\Migration;

/**
 * Class m200616_172923_marca
 */
class m200616_172923_marca extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('marca', 'nombre', $this->string(100)->notNull()->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200616_172923_marca cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200616_172923_marca cannot be reverted.\n";

        return false;
    }
    */
}
