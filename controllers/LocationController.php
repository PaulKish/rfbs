<?php

namespace app\controllers;

use Yii;
use app\models\Location;
use app\models\Country;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\helpers\ArrayHelper;

/**
 * LocationController implements the CRUD actions for Location model.
 */
class LocationController extends Controller
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
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'delete-multiple' => [
                'class' => 'mickgeek\actionbar\DeleteMultipleAction',
                'modelClass' => 'app\models\Location',
                'afterDeleteCallback' => function ($action) {
                    Yii::$app->getSession()->setFlash('success', 'The selected row(s) have been deleted successfully.');
                },
            ]
        ];
    }

    /**
     * Lists all Location models.
     * @return mixed
     */
    public function actionIndex()
    {
        $psize = Yii::$app->request->get('pagesize') !== null ? Yii::$app->request->get('pagesize') : 50;
        $dataProvider = new ActiveDataProvider([
            'query' => Location::find(),
            'pagination' => ['pagesize'=>$psize]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Location model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Location model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Location();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Record added');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $countries = ArrayHelper::map(Country::find()->all(), 'id', 'country');
            return $this->render('create', [
                'model' => $model,
                'countries' => $countries
            ]);
        }
    }

    /**
     * Updates an existing Location model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Record updated');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            $countries = ArrayHelper::map(Country::find()->all(), 'id', 'country');
            return $this->render('update', [
                'model' => $model,
                'countries' => $countries
            ]);
        }
    }

    /**
     * Deletes an existing Location model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Multiple delete
     */
    public function actionDeleteMultiple()
    {
        $ids = Yii::$app->request->post('ids');
        foreach($ids as $id){
            $this->findModel($id)->delete();
        }
    }

    /**
     * Multiple publish
     */
    public function actionPublish($status)
    {
        $ids = Yii::$app->request->post('ids');
        foreach($ids as $id){
            $model = $this->findModel($id);
            $model->active = $status;
            $model->save();
        }

        $message = 'published';
        if($status == 0){
            $message = 'unpublished';
        }

        Yii::$app->getSession()->setFlash('success',"The selected row(s) have been $message successfully");
        return $this->redirect(['index']);
    }

    /**
     * Finds the Location model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Location the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Location::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
