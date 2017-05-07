<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */

$this->title = 'Contributor Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rfbs-index">
	<div class="pull-right">
        <?= $this->render('/volume/_menu') ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <?php Pjax::begin(); ?>

    <div class="pull-left">
        <?php $form = ActiveForm::begin(['layout'=>'inline','method'=>'GET','action'=>'/rfbs/index']); ?>

        <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm',
                'startView' => 'months', 
                'minViewMode' => 'months'
            ]
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
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
        'tableOptions' => ['id'=>'contributor_report','class'=>'table-export table table-bordered'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'organization',
            'date:datetime',
            [
            	'label'=>'Volumes Submitted',
            	'format' => 'boolean',
            	'value'=> function ($data) use ($model) {
                	return $data->getVolume($model->date);
            	}
            ]
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>
	
</div>