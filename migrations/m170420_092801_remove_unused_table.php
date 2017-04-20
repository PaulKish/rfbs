<?php

use yii\db\Migration;

class m170420_092801_remove_unused_table extends Migration
{
    public function safeUp()
    {
        $this->dropForeignKey('{{%FK_type_group}}', 'type');
        $this->dropColumn('{{%type}}', 'group_id');
        $this->dropTable('{{%group}}');
    }

    public function safeDown()
    {
        echo "m170420_092801_remove_unused_table cannot be reverted.\n";
        return false;
    }
}
