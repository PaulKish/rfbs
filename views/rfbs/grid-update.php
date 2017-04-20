<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->title = 'Contributions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rfbs-grid">
    <div class="pull-right">
        <?= $this->render('/volume/_menu') ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

	<?php $form = ActiveForm::begin(['method'=>'GET']); ?>

    <?= $form->field($model, 'commodity')->dropDownList(
    $commodities,['prompt'=>'--Please select--']) ?>

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