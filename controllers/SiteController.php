<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use dektrium\user\filters\AccessRule;
use yii\web\Controller;
use yii\base\Model;
use app\models\Assignment;
use app\models\Country;
use app\models\Commodity;
use app\models\Contributor;
use app\models\FilterForm;
use app\models\Volume;
use app\models\Type;
use app\models\Report;
use app\models\GridForm;
use app\models\ContactForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;

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
                'only'  => [
                    'balance-sheet',
                    'surplus-deficit-report',
                    'tradeable-stock-report',
                    'production-estimate-report'
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'surplus-deficit-report',
                            'tradeable-stock-report',
                            'production-estimate-report'
                        ],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => false,
                        'actions' => ['balance-sheet','submission','submission-form'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role != 'Contributor';
                        },
                        'denyCallback'  => function ($rule, $action) {
                            Yii::$app->session->setFlash('error', 'This section is only for contributors');
                            return $this->goHome();
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['balance-sheet','submission','submission-form'],
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return Yii::$app->user->identity->role == 'Contributor';
                        },
                    ]
                ],
                'denyCallback'  => function ($rule, $action) {
                    Yii::$app->session->setFlash('error', 'This section is only for registered users. Please login to continue or sign up to get access');
                    Yii::$app->user->loginRequired();
                }
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
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
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
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['siteEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
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

    /**
     * Resources
     */ 
    public function actionResources(){
        $dataProvider = new ActiveDataProvider([
            'query' => Report::find()->where(['active'=>1])->orderBy('id desc'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('resources',['dataProvider'=>$dataProvider]);
    }

    /**
     * Contributor submission
     */
    public function actionSubmission(){
        $model = new GridForm;
        $model->scenario = 'submission';
        $commodities = ArrayHelper::map(Commodity::find()->all(),'id','commodity');

        return $this->render('submission',[
            'commodities' => $commodities,
            'model'=> $model
        ]);
    }

    /**
     * Contributor submission form
     */ 
    public function actionSubmissionForm(){
        $model = new GridForm;
        $model->scenario = 'submission';

        $user = Yii::$app->user->identity->username;
        $contributor = Contributor::find()->where(['username'=>$user])->one();

        // if no record exists prompt user with notice 
        if($contributor == NULL){
            Yii::$app->session->setFlash('error', 'Contributor account does not exist. Please contact EAGC');
            return $this->redirect('/site/index');
        }

        if ($model->load(Yii::$app->request->get())){
        
            // get assignments for role
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
                    $grid->user_id = $contributor->id;
                    $grid->product_id = $model->commodity;
                    $grid->active = 1;
                    $grid->save(false);
                }

                // flash message
                Yii::$app->session->setFlash('success', 'Submission added');

                return $this->redirect('submission');
            }

            return $this->render('submission_form',[
                'contributor' => $contributor,
                'assignments' => $assignments,
                'model' => $model,
                'gridModel' => $gridModel
            ]);

        } else {
            return $this->redirect('submission');
        }
    } 

    /**
     *  Contributor sign up
     *
    public function actionContributorSignUp(){
        $model = new Contributor();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Account created. Please follow the instructions on email');
            return $this->redirect('site/index');
        } else {
            // fetch drop down data
            $countries = ArrayHelper::map(Country::find()->all(), 'id', 'country');
            $roles = ArrayHelper::map(Role::find()->all(), 'id', 'role');

            return $this->render('contributor_signup', [
                'model' => $model,
                'countries' => $countries,
                'roles' => $roles
            ]);
        }
    } */
}
