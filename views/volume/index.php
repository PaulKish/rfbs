<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Volumes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volume-index">

    <div class="pull-left">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="pull-right">
        <?= $this->render('_menu') ?>
    </div>

    <div class="clearfix"></div>

    <hr>
    <?= $this->render('_search',['model'=>$searchModel]) ?>

    <hr> 

    <div class="pull-right">
        <?= \nterms\pagesize\PageSize::widget(['pageSizeParam'=>'pagesize','sizes'=>[10=>10,20=>20,50=>50,100=>100]]); ?>
    </div>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'filterPosition' => 'header',
        'filterSelector' => 'select[name="pagesize"]',
        'layout'=>"{items}\n <hr><div class='pull-left'>{pager}</div>
                    <div class='pull-right'>{summary}</div>",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'user.organization',
            'user.country.country',
            'product.commodity',
            'volume',
            'type.type',
            'date:date',
            'active:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
