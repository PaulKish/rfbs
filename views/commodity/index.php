<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use mickgeek\actionbar\Widget as ActionBar;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Commodities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="commodity-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <div class="clearfix"></div>
    <hr>

    <div class="pull-left">
        <?= ActionBar::widget([
            'grid' => 'commodity-grid',
            'templates' => [
                '{bulk-actions}' => ['class' => 'col-xs-6'],
                '{create}' => ['class' => 'col-xs-6'],
            ],
            'bulkActionsItems' => [
                'Publish' => 'Publish',
                'Unpublish' => 'Unpublish',
                'Delete' => 'Delete'
            ],
            'bulkActionsOptions' => [
                'options' => [
                    'Publish' => [
                        'url' => Url::toRoute(['publish', 'status' => 1]),
                    ],
                    'Unpublish' => [
                        'url' => Url::toRoute(['publish', 'status' => 0]),
                    ],
                    'Delete' => [
                        'url' => Url::toRoute('delete-multiple'),
                        'data-confirm' => 'Are you sure?'
                    ],
                ],
                'class' => 'form-control',
            ],
        ]) ?>
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
        'id' => 'commodity-grid',
        'layout'=>"{items}\n <hr><div class='pull-left'>{pager}</div>
                    <div class='pull-right'>{summary}</div>",
        'filterSelector' => 'select[name="pagesize"]',
        'tableOptions' => ['id'=>'contributors','class'=>'table-export table table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
            ['class' => 'yii\grid\SerialColumn'],

            'commodity',
            'active:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
