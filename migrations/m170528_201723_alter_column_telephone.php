<?php

use yii\db\Migration;

class m170528_201723_alter_column_telephone extends Migration
{
    public function safeUp()
    {
        $this->alterColumn('{{%contributor}}', 'telephone', 'VARCHAR(50)');
        $this->alterColumn('{{%contributor}}', 'telephone_2', 'VARCHAR(50)');
    }

    public function safeDown()
    {
        echo "m170528_201723_alter_column_telephone cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170528_201723_alter_column_telephone cannot be reverted.\n";

        return false;
    }
    */
}
