<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->title = 'Data Submission';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rfbs-grid">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

	<?php $form = ActiveForm::begin(['method'=>'GET','action'=>'submission-form']); ?>

    <?= $form->field($model, 'commodity')->dropDownList(
    $commodities,['prompt'=>'--Please select--']) ?>

	<?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight'=>true
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Generate Form', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>