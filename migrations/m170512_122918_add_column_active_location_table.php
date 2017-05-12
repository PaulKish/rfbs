<?php

use yii\db\Migration;

class m170512_122918_add_column_active_location_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%location}}', 'active', $this->integer(1)->after('location'));
    }

    public function safeDown()
    {
        echo "m170512_122918_add_column_active_location_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170512_122918_add_column_active_location_table cannot be reverted.\n";

        return false;
    }
    */
}
