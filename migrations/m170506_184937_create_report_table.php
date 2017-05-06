<?php

use yii\db\Migration;

/**
 * Handles the creation of table `report`.
 */
class m170506_184937_create_report_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('report', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'upload' => $this->text(),
            'date' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('report');
    }
}
