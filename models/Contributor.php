<?php

namespace app\models;

use Yii;

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
            [['telephone', 'role_id', 'country_id', 'active'], 'integer'],
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
            'role_id' => 'Role ID',
            'country_id' => 'Country ID',
            'date' => 'Date',
            'active' => 'Active',
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
}