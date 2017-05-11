<?php

use yii\db\Migration;

/**
 * Handles the creation of table `location`.
 */
class m170511_081722_create_location_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('location', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer()->notNull(),
            'location' => $this->string()->notNull(),
        ],'ENGINE=InnoDB');

        // add foreign key for table country
        $this->addForeignKey(
            'fk-location-country-id',
            'location',
            'country_id',
            'country',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('location');
    }
}
