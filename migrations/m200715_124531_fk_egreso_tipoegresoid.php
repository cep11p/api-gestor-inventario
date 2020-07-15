<?php

use yii\db\Migration;

/**
 * Class m200715_124531_fk_egreso_tipoegresoid
 */
class m200715_124531_fk_egreso_tipoegresoid extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('egreso', 'tipo_egresoid', $this->integer());
        $this->addForeignKey('fk_tipoegresoid', 'egreso', 'tipo_egresoid', 'tipo_egreso', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m200715_124531_fk_egreso_tipoegresoid cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200715_124531_fk_egreso_tipoegresoid cannot be reverted.\n";

        return false;
    }
    */
}
