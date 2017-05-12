<?php

namespace app\models;

use Yii;
use app\Models\User;
use dektrium\user\Finder;

/**
 * This is the model class for table "contributor".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $telephone
 * @property string $organization
 * @property int $role_id
 * @property int $country_id
 * @property string $date
 * @property int $active
 *
 * @property Country $country
 * @property Role $role
 * @property Volume[] $volumes
 */
class Contributor extends \yii\db\ActiveRecord
{
    public $month;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contributor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['telephone'], 'integer'],
            [['email'],'email'],
            [['username','password','email','organization','telephone','country_id','location_id'],'required'],
            ['username', 'unique', 'targetAttribute' => ['username'], 'message' => 'Username must be unique.'],
            [['date'], 'safe'],
            [['username', 'password', 'email', 'organization'], 'string', 'max' => 50],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['role_id'], 'exist', 'skipOnError' => true, 'targetClass' => Role::className(), 'targetAttribute' => ['role_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'organization' => 'Organization',
            'role_id' => 'Role',
            'country_id' => 'Country',
            'location_id' => 'Location',
            'date' => 'Date',
            'active' => 'Active',
            'volume' => 'Volumes Submitted'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(), ['id' => 'role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolumes()
    {
        return $this->hasMany(Volume::className(), ['user_id' => 'id']);
    }


    public function getName(){
        return $this->organization.' - '.$this->username;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVolume($month)
    {
        $month = explode('-',$month);
        $volume = Volume::find()
            ->where(['user_id'=>$this->id])
            ->andWhere("MONTH(volume.date) = {$month[1]} ")
            ->andWhere("YEAR(volume.date) = {$month[0]}")
            ->one();

        return (bool)$volume;
    }

    /**
     *  After Save
     *  Create new account for each contributor
     */ 
    public function afterSave($insert, $changedAttributes) {
        parent::afterSave($insert, $changedAttributes);
        
        // only run on insert, use yii command to create user
        if($insert){
            $user = Yii::createObject([
                'class'    => User::className(),
                'scenario' => 'create',
                'email'    => $this->email,
                'username' => $this->username,
                //'password' => $password,
                'role'     => 'Contributor'
            ]);

            if ($user->create()) {
               Yii::$app->getSession()->setFlash('success',"User account created");
            } else {
                foreach ($user->errors as $errors) {
                    foreach ($errors as $error) {
                        Yii::$app->getSession()->setFlash('error',$error);
                    }
                }
            }
        }
    }
}
