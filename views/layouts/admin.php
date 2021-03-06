<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?= Yii::$app->language ?>"> <!--<![endif]-->
	<head>
		<meta charset="<?= Yii::$app->charset ?>">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<?= Html::csrfMetaTags() ?>
	    <title><?= Html::encode($this->title) ?></title>
	    <?php $this->head() ?>
	</head>
	<body>
		<!--[if lt IE 8]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<?php $this->beginBody() ?>

		<div class="wrap">
		    <?php
		    NavBar::begin([
		        'brandLabel' => Yii::$app->name.' | Administration',
		        'brandUrl' => Yii::$app->homeUrl,
		        'options' => [
		            'class' => 'navbar-default navbar-fixed-top',
		        ],
		    ]);
		    echo Nav::widget([
		        'options' => ['class' => 'navbar-nav navbar-right'],
		        'items' => [
		        	['label' => 'Dashboard', 
		            	'url' => ['/volume/index'],
		            	'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin,
		            ],
		            ['label' => 'Main Site', 
		            	'url' => ['/site/index'],
		            	'linkOptions' => ['target' => '_blank']
		            ],
		            ['label' => 'Account', 
                        'items'=> [
                            [
                                'label' => 'Login',
                                'url' => ['/user/security/login'],
                                'visible'=> Yii::$app->user->isGuest
                            ],
                            [
                                'label' => 'Register',
                                'url' => ['/user/register'],
                                'visible'=> Yii::$app->user->isGuest
                            ],
                            [
                                'label' => 'Admin',
                                'url' => ['/volume/index'],
                                'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin,
                                'linkOptions' => ['data-method' => 'post'],
                            ],
                            ['label' => 'Sign out',
                                'url' => ['/user/security/logout'],
                                'visible' => !Yii::$app->user->isGuest,
                                'linkOptions' => ['data-method' => 'post'],
                            ],
                        ]
                    ],
				],
		    ]);
		    NavBar::end();
		    ?>

		    <div class="container">
		        <?= Breadcrumbs::widget([
		            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		        ]) ?>

		        <?= Alert::widget() ?>


        		<div class="panel panel-default">
					<div class="panel-body">
		        		<?= Nav::widget([
						        'options' => ['class' => 'nav-pills'],
						        'items' => [
						        	['label' => 'Volume', 'url' => ['/volume/index']],
						        	['label' => 'Resources', 'url' => ['/report/index']],
						            ['label' => 'Commodities', 'url' => ['/commodity/index']],
						            ['label' => 'Contributors', 'url' => ['/contributor/index']],
						            ['label' => 'Countries', 'url' => ['/country/index']],
						            ['label' => 'Locations', 'url' => ['/location/index']],	  
						            ['label' => 'Site Users', 'url' => ['/user/admin']],
						            ['label' => 'RFBS Settings', 'url' => ['/assignment/index']],
						        ],
						    ]);
						?>
        			</div>
        		</div>
        		
		        <div class="panel panel-default">
					<div class="panel-body">
        				<?= $content ?>
        			</div>
        		</div>
		    </div>
		</div>

		<footer class="footer">
		    <div class="container">
		        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

		        <p class="pull-right"><?= Yii::powered() ?></p>
		    </div>
		</footer>

		<?php $this->endBody() ?>
		
	</body>
</html>
<?php $this->endPage() ?>