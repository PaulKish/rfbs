<?php

namespace app\controllers;

use Yii;
use app\models\Volume;
use app\models\VolumeSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use app\models\Type;
use app\models\Commodity;
use app\models\Contributor;
use app\models\Country;
use yii\helpers\ArrayHelper;


/**
 * VolumeController implements the CRUD actions for volume model.
 */
class VolumeController extends Controller
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
                'modelClass' => 'app\models\Volume',
                'afterDeleteCallback' => function ($action) {
                    Yii::$app->getSession()->setFlash('success', 'The selected rows have been deleted successfully.');
                },
            ]
        ];
    }

    /**
     * Lists all volume models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VolumeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //dump(Yii::$app->user->identity->role);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }

    /**
     * Displays a single volume model.
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
     * Creates a new volume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new volume();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Record added');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            //fetch dropdown data
            $types = ArrayHelper::map(Type::find()->all(), 'id', 'type');
            $commodities = ArrayHelper::map(Commodity::find()->all(), 'id', 'commodity');
            $contributors = ArrayHelper::map(Contributor::find()->all(), 'id', 'name');

            return $this->render('create', [
                'model' => $model,
                'types' => $types,
                'commodities' => $commodities,
                'contributors' => $contributors
            ]);
        }
    }

    /**
     * Updates an existing volume model.
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
            //fetch dropdown data
            $types = ArrayHelper::map(Type::find()->all(), 'id', 'type');
            $commodities = ArrayHelper::map(Commodity::find()->all(), 'id', 'commodity');
            $contributors = ArrayHelper::map(Contributor::find()->all(), 'id', 'name');

            return $this->render('update', [
                'model' => $model,
                'types' => $types,
                'commodities' => $commodities,
                'contributors' => $contributors
            ]);
        }
    }

    /**
     * Deletes an existing volume model.
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
     * Multiple delete
     */
    public function actionPublish($status)
    {
        $ids = Yii::$app->request->post('ids');
        foreach($ids as $id){
            $volume = $this->findModel($id);
            $volume->active = $status;
            $volume->save();
        }

        $message = 'published';
        if($status == 0){
            $message = 'unpublished';
        }

        Yii::$app->getSession()->setFlash('success',"The selected rows have been $message successfully");
        return $this->redirect(['index']);
    }

    /**
     * Finds the volume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return volume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = volume::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
