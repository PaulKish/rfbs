<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\ActiveForm;
use mickgeek\actionbar\Widget as ActionBar;
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
    <?php Pjax::begin(); ?>
    
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      Filter Options
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?= $this->render('_search',['model'=>$searchModel]) ?>
                </div>
            </div>
        </div>
    </div>
    

    <hr> 

    <div class="pull-left">
        <?= ActionBar::widget([
            'grid' => 'volume-grid',
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
            'sizes'=>[20 => 20,50 => 50,100 => 100],
            'template'=>'{list}',
            'options'=>['class'=>'form-control']
        ]); ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'id'=>'volume-grid',
        'filterPosition' => 'header',
        'filterSelector' => 'select[name="pagesize"]',
        'layout'=>"{items}\n <hr><div class='pull-left'>{pager}</div>
                    <div class='pull-right'>{summary}</div>",
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn'],
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
