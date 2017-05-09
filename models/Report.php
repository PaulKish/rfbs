<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "report".
 *
 * @property int $id
 * @property string $title
 * @property string $upload
 */
class Report extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title','category','content','active'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['category','content'],'string'],
            ['upload', 'file', 'extensions' => 'doc, docx, pdf, jpeg, jpg, png', 'on' => ['insert', 'update']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'upload' => 'Upload',
            'content' => 'Content',
            'category' => 'Category',
            'active'  => 'Active'
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            [
                'class' => \mongosoft\file\UploadBehavior::className(),
                'attribute' => 'upload',
                'scenarios' => ['insert', 'update'],
                'path' => '@webroot/upload/{id}',
                'url' => '@web/upload/{id}',
            ],
        ];
    }
}
