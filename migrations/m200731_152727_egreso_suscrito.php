<?php

use yii\db\Migration;

/**
 * Class m200731_152727_egreso_suscrito
 */
class m200731_152727_egreso_suscrito extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = 'egreso';
        $this->addColumn($table, 'suscrito', $this->string('70'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200731_152727_egreso_suscrito cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200731_152727_egreso_suscrito cannot be reverted.\n";

        return false;
    }
    */
}
