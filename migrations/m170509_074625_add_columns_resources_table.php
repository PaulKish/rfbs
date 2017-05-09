<?php

use yii\db\Migration;

class m170509_074625_add_columns_resources_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%report}}', 'content', $this->text()->after('title'));
        $this->addColumn('{{%report}}', 'category', $this->string(50)->after('content'));
        $this->addColumn('{{%report}}', 'active', $this->integer(1)->defaultValue(0)->after('upload'));
    }

    public function safeDown()
    {
        echo "m170509_074625_add_columns_resources_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170509_074625_add_columns_resources_table cannot be reverted.\n";

        return false;
    }
    */
}
