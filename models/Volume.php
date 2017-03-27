<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "volume".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property string $volume
 * @property int $type_id
 * @property string $date
 * @property string $time
 * @property int $active
 *
 * @property Commodity $product
 * @property Contributor $user
 * @property Type $type
 */
class Volume extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'volume';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'type_id', 'active'], 'integer'],
            [['volume'], 'number'],
            [['date', 'time'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Commodity::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contributor::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => Type::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'volume' => 'Volume',
            'type_id' => 'Type ID',
            'date' => 'Date',
            'time' => 'Time',
            'active' => 'Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Commodity::className(), ['id' => 'product_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Contributor::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(Type::className(), ['id' => 'type_id']);
    }
}
