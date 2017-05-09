<?php

namespace app\controllers;

use Yii;
use app\models\Contributor;
use app\models\ContributorSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use app\models\Country;
use app\models\Role;
use yii\helpers\ArrayHelper;

/**
 * ContributorController implements the CRUD actions for contributor model.
 */
class ContributorController extends Controller
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
                'modelClass' => 'app\models\Contributor',
                'afterDeleteCallback' => function ($action) {
                    Yii::$app->getSession()->setFlash('success', 'The selected row(s) have been deleted successfully.');
                },
            ]
        ];
    }

    /**
     * Lists all contributor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContributorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single contributor model.
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
     * Creates a new contributor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new contributor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Record added');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            // fetch drop down data
            $countries = ArrayHelper::map(Country::find()->all(), 'id', 'country');
            $roles = ArrayHelper::map(Role::find()->all(), 'id', 'role');

            return $this->render('create', [
                'model' => $model,
                'countries' => $countries,
                'roles' => $roles
            ]);
        }
    }

    /**
     * Updates an existing contributor model.
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
            // fetch drop down data
            $countries = ArrayHelper::map(Country::find()->all(), 'id', 'country');
            $roles = ArrayHelper::map(Role::find()->all(), 'id', 'role');

            return $this->render('update', [
                'model' => $model,
                'countries' => $countries,
                'roles' => $roles
            ]);
        }
    }

    /**
     * Deletes an existing contributor model.
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
     * Finds the contributor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return contributor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = contributor::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
