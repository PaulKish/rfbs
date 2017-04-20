<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\web\Controller;
use app\models\Country;
use app\models\Commodity;
use app\models\FilterForm;
use app\models\Volume;
use app\models\Type;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['report'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['report'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = new FilterForm;

        $date = date('Y-m');
        $model->date = $date;

        $countries = ArrayHelper::map(Country::find()->where(['active'=>1])->all(),'id','country');
        $commodities = ArrayHelper::map(Commodity::find()->where(['active'=>1])->all(),'id','commodity');
    
        if (!$model->load(Yii::$app->request->get())){
            $model->commodity = 1;
            $model->country = 0;
        }

        return $this->render('index',[
            'model'=>$model,
            'countries'=>$countries,
            'commodities'=>$commodities
        ]);
    }

    /**
     * Displays about.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * Displays contact.
     *
     * @return string
     */
    public function actionContact()
    {
        return $this->render('contact');
    }

    /**
     * Displays report.
     *
     * @return string
     */
    public function actionReport()
    {
        $countries = ArrayHelper::map(Country::find()->where(['active'=>1])->all(),'id','country');
        $commodities = ArrayHelper::map(Commodity::find()->where(['active'=>1])->all(),'id','commodity');

        $model = new FilterForm;

        $countries = [ 0 => 'Regional'] + $countries;

        if (!$model->load(Yii::$app->request->post())){
            $model->date = date('Y-m-01');
            $model->end_date = date('Y-m-t');
            $model->commodity = 1;
        }

        return $this->render('report',[
            'countries' => $countries,
            'commodities'=>$commodities,
            'model' => $model
        ]);
    }
}
