<?php

use yii\db\Migration;

class m170518_082210_default_value_volume_active extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%volume}}', 'active', $this->integer()->notNull()->defaultValue(1));
    }

    public function safeDown()
    {
        echo "m170518_082210_default_value_volume_active cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170518_082210_default_value_volume_active cannot be reverted.\n";

        return false;
    }
    */
}
