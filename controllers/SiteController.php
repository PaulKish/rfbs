<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\web\Controller;
use app\models\Country;
use app\models\Commodity;
use yii\helpers\Url;

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
        $commodities = Commodity::find()->where(['active'=>1])->all();

        $menu = [];
        foreach ($commodities as $commodity) {
            $menu[] = [
                'label' => $commodity->commodity, 
                'url' => Url::to(['site/report','product'=>$commodity->id])
            ];
        }

        return $this->render('report',[
            'countries' => $countries,
            'menu' => $menu
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
