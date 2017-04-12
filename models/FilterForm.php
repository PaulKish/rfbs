<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FilterForm extends Model
{
    public $date;
    public $commodity;

    public function rules()
    {
        return [
            [['date','commodity'], 'required'],
        ];
    }
}