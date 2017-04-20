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
            [['date', 'time','type_id','volume'], 'safe'],
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
            'user_id' => 'Contributor',
            'product_id' => 'Commodity',
            'volume' => 'Volume',
            'type_id' => 'Type',
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

    public static function typeVolume($type,$product,$date=NULL,$country=NULL,$end_date = NULL){
        if($date == NULL){
            $date = date('Y-m-01');
        }

        if($end_date == NULL){
            $end_date = date('Y-m-t'); // this will fail after 2038
        }

        // this is to accomodate adding a regional country with id 0 
        if($country == 0){
            $country = NULL;
        }

        $formatter = \Yii::$app->formatter;

        $volume = Volume::find()
            ->where(['type_id'=>$type])
            ->andWhere(['product_id'=>$product])
            ->andWhere(['between','volume.date',$date,$end_date])
            ->joinWith(['user' => function ($q) use ($country) {
                $q->andFilterWhere(['=', 'contributor.country_id',$country]);
            }])
            ->sum('volume');

        if($volume == NULL)
            $volume = 0;

        return $formatter->asDecimal($volume,2);
    }

    /**
     * Category volume
     */ 
    public static function catVolume($category,$product,$date=NULL,$country=NULL){
        if($date == NULL){
            $date = date('Y-m');
        }

        // this is to accomodate adding a regional country with id 0 
        if($country == 0){
            $country = NULL;
        }

        $date = explode('-',$date);

        $formatter = \Yii::$app->formatter;

        $volume = Volume::find()
            ->where(['product_id'=>$product])
            ->andWhere("MONTH(volume.date) = {$date[1]} ")
            ->andWhere("YEAR(volume.date) = {$date[0]}")
            //->andWhere(['volume.active'=>1])
            ->joinWith(
                ['user' => function ($q) use ($country) {
                    $q->andFilterWhere(['=', 'contributor.country_id',$country]);
                },'type' => function ($q) use ($category) {
                    $q->andWhere(['=', 'type.category_id',$category]);
                }]
            )
            ->sum('volume');

        if($volume == NULL)
            $volume = 0;

        return $formatter->asDecimal($volume,2);
    }
}
