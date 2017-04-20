<?php

use yii\db\Migration;
use yii\db\Schema;

class m170420_084626_add_new_field_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'role', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');
    }
}
