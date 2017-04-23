<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "commodity".
 *
 * @property int $id
 * @property string $commodity
 * @property int $active
 *
 * @property Volume[] $volumes
 */
class Commodity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'commodity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['active'], 'integer'],
            [['commodity'], 'string', 'max' => 50],
            [['commodity'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'commodity' => 'Commodity',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolumes()
    {
        return $this->hasMany(Volume::className(), ['product_id' => 'id']);
    }
}
