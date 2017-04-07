<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->title = 'RFBS - Grid';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rfbs-grid">
<?= $this->render('_menu') ?>
	<?php $form = ActiveForm::begin(['method'=>'GET','action'=>'grid-form']); ?>

    <?= $form->field($model, 'commodity')->dropDownList(
    $commodities,['prompt'=>'--Please select--']) ?>

    <?= $form->field($model, 'contributor')->dropDownList(
    $contributors,['prompt'=>'--Please select--']) ?>

	<?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Generate', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>