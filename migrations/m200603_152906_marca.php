<?php

use yii\db\Migration;

/**
 * Class m200603_152906_marca
 */
class m200603_152906_marca extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('marca', 'nombre', $this->string(100)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200603_152906_marca cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200603_152906_marca cannot be reverted.\n";

        return false;
    }
    */
}
