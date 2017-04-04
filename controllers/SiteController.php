<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class SiteController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
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
     * Displays contact.
     *
     * @return string
     */
    public function actionContact()
    {
        return $this->render('index');
    }
}
