<?php

use yii\db\Migration;

class m170511_082238_add_location_key extends Migration
{
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-contributor-location-id',
            'contributor',
            'location_id',
            'location',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        echo "m170511_082238_add_location_key cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170511_082238_add_location_key cannot be reverted.\n";

        return false;
    }
    */
}
