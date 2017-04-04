<?php

namespace app\controllers;

use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;

class RfbsController extends \yii\web\Controller
{
    public $layout = 'admin';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ]
        ];
    }

    public function actionGenerate()
    {
        return $this->render('generate');
    }

    public function actionGrid()
    {
        return $this->render('grid');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
