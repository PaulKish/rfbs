<?php

namespace app\models;

use Yii;
use yii\base\Model;

class FilterForm extends Model
{
    public $date;
    public $end_date;
    public $commodity;
    public $country;

    public function rules()
    {
        return [
            [['commodity'], 'required'],
            [['country','date','end_date'],'safe']
        ];
    }
}