<?php

use yii\db\Migration;

class m170512_134451_add_index_unique_contributor extends Migration
{
    public function safeUp()
    {
        $this->createIndex('contributor_unique_username','contributor',['username'], true);
    }

    public function safeDown()
    {
        echo "m170512_134451_add_index_unique_contributor cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170512_134451_add_index_unique_contributor cannot be reverted.\n";

        return false;
    }
    */
}
