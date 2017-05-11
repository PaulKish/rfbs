<?php

use yii\db\Migration;

class m170511_081430_add_column_location extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%contributor}}', 'location_id', $this->integer(10)->after('country_id'));
    }

    public function safeDown()
    {
        echo "m170511_081430_add_column_location cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170511_081430_add_column_location cannot be reverted.\n";

        return false;
    }
    */
}
