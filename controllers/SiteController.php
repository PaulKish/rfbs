<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\web\Controller;
use app\models\Country;
use app\models\Commodity;
use app\models\FilterForm;
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
        return $this->render('index');
    }

    /**
     * Displays about.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('index');
    }

    /**
     * Displays report.
     *
     * @return string
     */
    public function actionReport()
    {
        $countries = Country::find()->where(['active'=>1])->all();
        $commodities = ArrayHelper::map(Commodity::find()->where(['active'=>1])->all(),'id','commodity');

        $model = new FilterForm;

        if (!$model->load(Yii::$app->request->post())){
            $model->date = date('Y-m');
            $model->commodity = 1;
        }

        return $this->render('report',[
            'countries' => $countries,
            'commodities'=>$commodities,
            'model' => $model
        ]);
    }

    /**
     * Displays contact.
     *
     * @return string
     */
    public function actionContact()
    {
        return $this->render('index');
    }
}
