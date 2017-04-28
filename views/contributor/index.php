<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contributors';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contributor-index">

    <div class="pull-left">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="pull-right">
        <?= Html::a('Create Contributor', ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php Pjax::begin(); ?>

    <div class="clearfix"></div>
    <hr>

    <div class="pull-right">
        <?= \nterms\pagesize\PageSize::widget(['pageSizeParam'=>'pagesize','sizes'=>[10=>10,20=>20,50=>50,100=>100]]); ?>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n <hr><div class='pull-left'>{pager}</div>
                    <div class='pull-right'>{summary}</div>",
        'filterSelector' => 'select[name="pagesize"]',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'organization',
            'role.role',
            'country.country',
            'date',
            'active:boolean',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
</div>
