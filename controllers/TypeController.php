<?php

namespace app\controllers;

use Yii;
use app\models\Type;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use app\models\Category;
use yii\helpers\ArrayHelper;
/**
 * TypeController implements the CRUD actions for type model.
 */
class TypeController extends Controller
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

    /**
     * Lists all type models.
     * @return mixed
     */
    public function actionIndex()
    {
        $psize = Yii::$app->request->get('pagesize') !== null ? Yii::$app->request->get('pagesize') : 50;
        $dataProvider = new ActiveDataProvider([
            'query' => type::find(),
            'pagination' => ['pagesize'=>$psize]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single type model.
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
     * Creates a new type model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new type();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Record added');
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            // fetch drop down data
            $categories = ArrayHelper::map(Category::find()->all(), 'id', 'category');

            return $this->render('create', [
                'model' => $model,
                'categories' => $categories
            ]);
        }
    }

    /**
     * Updates an existing type model.
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
            $categories = ArrayHelper::map(Category::find()->all(), 'id', 'category');

            return $this->render('update', [
                'model' => $model,
                'categories' => $categories
            ]);
        }
    }

    /**
     * Deletes an existing type model.
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
     * Finds the type model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return type the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = type::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
