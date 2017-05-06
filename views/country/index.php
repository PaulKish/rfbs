<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Countries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="country-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <div class="clearfix"></div>
    <hr>

    <div class="pull-left">
        <?= Html::a('Create Country', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <div class="pull-right">
        <?= \nterms\pagesize\PageSize::widget([
            'pageSizeParam'=>'pagesize',
            'defaultPageSize'=>50,
            'sizes'=>[20 => 20,50 => 50,100 => 100,200 => 200],
            'template'=>'{list}',
            'options'=>['class'=>'form-control']
        ]); ?>
    </div>

    <div class="clearfix"></div>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n <hr><div class='pull-left'>{pager}</div>
                    <div class='pull-right'>{summary}</div>",
        'filterSelector' => 'select[name="pagesize"]',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'country',
            'active:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
