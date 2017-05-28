<?php

use yii\db\Migration;

class m170528_185204_add_columns_location_mobile_no_contributor_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%contributor}}', 'latitude', $this->decimal(8,6)->after('location_id'));
        $this->addColumn('{{%contributor}}', 'longitude', $this->decimal(8,6)->after('latitude'));
        $this->addColumn('{{%contributor}}', 'telephone_2', $this->integer(10)->after('telephone'));
    }

    public function safeDown()
    {
        echo "m170528_185204_add_columns_location_mobile_no_contributor_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170528_185204_add_columns_location_mobile_no_contributor_table cannot be reverted.\n";

        return false;
    }
    */
}
