<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contributions | '.$commodity;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volume-index">
    <div class="pull-right">
        <?= $this->render('_menu') ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php Pjax::begin(); ?>

    <div class="clearfix"></div>
    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n <hr><div class='pull-left'>{pager}</div>
                    <div class='pull-right'>{summary}</div>",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user.organization',
            'user.country.country',
            'product.commodity',
            [
                'attribute'=>'date',
                'format'=> ['date', 'php:F, Y']
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Update',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) use ($gridModel) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', 
                            Url::to(['rfbs/grid-form-update','id'=>$model->user_id,'product'=>$gridModel->commodity,'date'=>$model->date]),
                            ['title' => Yii::t('app', 'update'),'class'=>'btn btn-xs btn-default']);
                    },
                ]
            ],
        ],
            
    ]); ?>

    <?php Pjax::end(); ?>
</div>
