<?php

namespace app\models;

use Yii;
use yii\base\Model;

class GridForm extends Model
{
    public $commodity;
    public $contributor;
    public $date;

    public function rules()
    {
        return [
            [['commodity', 'contributor', 'date'], 'required'],
        ];
    }
}