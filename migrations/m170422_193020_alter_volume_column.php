<?php

use yii\db\Migration;

class m170422_193020_alter_volume_column extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%volume}}', 'volume', 'DECIMAL(10,2)');
    }

    public function safeDown()
    {
        echo "m170422_193020_alter_volume_column cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170422_193020_alter_volume_column cannot be reverted.\n";

        return false;
    }
    */
}
