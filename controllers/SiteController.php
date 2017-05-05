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
     */
    public function actionIndex()
    {
        $model = new FilterForm;

        $date = date('Y-m',strtotime("-1 month"));
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
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * Displays contact.
     */
    public function actionContact()
    {
        return $this->render('contact');
    }

    /**
     * Displays balance sheet.
     */
    public function actionBalanceSheet()
    {
        $countries = ArrayHelper::map(Country::find()->where(['active'=>1])->all(),'id','country');
        $commodities = ArrayHelper::map(Commodity::find()->where(['active'=>1])->all(),'id','commodity');

        $model = new FilterForm;

        $countries = [ 0 => 'Regional'] + $countries;

        if (!$model->load(Yii::$app->request->post())){
            $model->date = date('Y-m-01',strtotime("-1 month"));
            $model->end_date = date('Y-m-t',strtotime("-1 month"));
            $model->commodity = 1;
        }

        return $this->render('balance_sheet',[
            'countries' => $countries,
            'commodities'=>$commodities,
            'model' => $model
        ]);
    }

    /**
     * Displays surplus deficit report.
     */ 
    public function actionSurplusDeficitReport(){
        $model = new FilterForm;

        $model->date = date('Y-m-01',strtotime("-1 month"));
        $model->end_date = date('Y-m-t',strtotime("-1 month"));

        $countries = ArrayHelper::map(Country::find()->where(['active'=>1])->all(),'id','country');
        $commodities = ArrayHelper::map(Commodity::find()->where(['active'=>1])->all(),'id','commodity');
    
        if (!$model->load(Yii::$app->request->get())){
            $model->commodity = 1;
            $model->country = 0;
        }

        return $this->render('surplus_deficit',[
            'model'=>$model,
            'countries'=>$countries,
            'commodities'=>$commodities
        ]);
    }

    /**
     * Tradeable stock report.
     */ 
    public function actionTradeableStockReport(){
        $model = new FilterForm;

        $model->date = date('Y-m-01',strtotime("-1 month"));
        $model->end_date = date('Y-m-t',strtotime("-1 month"));

        $countries = ArrayHelper::map(Country::find()->where(['active'=>1])->all(),'id','country');
        $commodities = ArrayHelper::map(Commodity::find()->where(['active'=>1])->all(),'id','commodity');
    
        if (!$model->load(Yii::$app->request->get())){
            $model->commodity = 1;
            $model->country = 0;
        }

        return $this->render('tradeable_stock',[
            'model'=>$model,
            'countries'=>$countries,
            'commodities'=>$commodities
        ]);
    }

    /**
     * Production estimate report.
     */
    public function actionProductionEstimateReport(){
        $model = new FilterForm;

        $model->date = date('Y-m-01',strtotime("-1 month"));
        $model->end_date = date('Y-m-t',strtotime("-1 month"));

        $countries = ArrayHelper::map(Country::find()->where(['active'=>1])->all(),'id','country');
        $commodities = ArrayHelper::map(Commodity::find()->where(['active'=>1])->all(),'id','commodity');
    
        if (!$model->load(Yii::$app->request->get())){
            $model->commodity = 1;
            $model->country = 0;
        }

        return $this->render('production_estimate',[
            'model'=>$model,
            'countries'=>$countries,
            'commodities'=>$commodities
        ]);
    } 
}
