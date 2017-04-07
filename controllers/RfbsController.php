<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\base\Model;
use app\models\Country;
use app\models\Commodity;
use app\models\Contributor;
use app\models\GridForm;
use app\models\Assignment;
use app\models\Volume;
use yii\helpers\ArrayHelper;


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

    /**
     *  Index, shows generated sheets
     */ 
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     *  Generate Sheet
     */ 
    public function actionGenerate()
    {
        return $this->render('generate');
    }

    /**
     *  Grid filter
     */ 
    public function actionGrid()
    {
        $model = new GridForm;
        $model->scenario = 'create';
        $commodities = ArrayHelper::map(Commodity::find()->all(),'id','commodity');
        $contributors = ArrayHelper::map(Contributor::find()->all(),'id','name');

        return $this->render('grid',[
            'commodities' => $commodities,
            'contributors' => $contributors,
            'model'=> $model
        ]);
    }

    /**
     *  Generated Grid form
     */ 
    public function actionGridForm(){
        $model = new GridForm;
        $model->scenario = 'create';
        if ($model->load(Yii::$app->request->get())){
        
            // get assignments for role
            $contributor = Contributor::findOne($model->contributor);
            $assignments = Assignment::find()->where(['role_id'=>$contributor->role_id])->all();

            // bad stuff
            $count = Assignment::find()->where(['role_id'=>$contributor->role_id])->count();
            for($i = 0; $i < $count; $i++){
                $gridModel[$i] = new Volume();
            }

            // multiple madness
            if (Model::loadMultiple($gridModel, Yii::$app->request->post()) && Model::validateMultiple($gridModel)) {
                foreach ($gridModel as $grid) {
                    $grid->date = $model->date;
                    $grid->user_id = $model->contributor;
                    $grid->product_id = $model->commodity;
                    $grid->active = 1;
                    $grid->save(false);
                }

                // flash message
                Yii::$app->session->setFlash('success', 'Record added');

                return $this->redirect('index');
            }

            return $this->render('grid-form',[
                'contributor' => $contributor,
                'assignments' => $assignments,
                'model' => $model,
                'gridModel' => $gridModel
            ]);

        } else {
            return $this->redirect('index');
        }
    }

    /**
     *  Grid update
     */ 
    public function actionGridUpdate()
    {
        $model = new GridForm;
        $model->scenario = 'update';

        // show grid
        if ($model->load(Yii::$app->request->get())){
            $date = explode('-',$model->date);
            $dataProvider = new ActiveDataProvider([
                'query' => Volume::find()
                    ->where(['product_id'=>$model->commodity])
                    ->andWhere("MONTH(date) = {$date[1]} ")
                    ->andWhere("YEAR(date) = {$date[0]}")
                    ->groupBy('user_id'),
                'pagination' => ['pagesize'=>10]
            ]);

            return $this->render('grid-index', [
                'dataProvider' => $dataProvider,
                'gridModel'=> $model
            ]);
        }

        $commodities = ArrayHelper::map(Commodity::find()->all(),'id','commodity');

        return $this->render('grid-update',[
            'commodities' => $commodities,
            'model'=> $model
        ]);
    }

    /**
     *  Update contributor records
     */ 
    public function actionGridFormUpdate($id,$product,$date){
        $date = explode('-',$date);

        // pull records
        $gridModel = Volume::find()
            ->where(['user_id'=>$id])
            ->andWhere(['product_id'=>$product])
            ->andWhere("MONTH(date) = {$date[1]} ")
            ->andWhere("YEAR(date) = {$date[0]}")
            ->indexBy('id')
            ->all();

        // multiple madness
        if (Model::loadMultiple($gridModel, Yii::$app->request->post()) && Model::validateMultiple($gridModel)) {
            foreach ($gridModel as $grid) {
                $grid->save(false);
            }

            // flash message
            Yii::$app->session->setFlash('success', 'Record added');
            
            return $this->redirect('index');
        }

        return $this->render('grid-form-update',[
            'gridModel' => $gridModel
        ]); 
    }

}
