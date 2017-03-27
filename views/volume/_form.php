<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\volume */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="volume-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->dropDownList(
    $contributors,['prompt'=>'--Please select--']) ?>

    <?= $form->field($model, 'product_id')->dropDownList(
    $commodities,['prompt'=>'--Please select--']) ?>

    <?= $form->field($model, 'volume')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->dropDownList(
    $types,['prompt'=>'--Please select--']) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <?= $form->field($model, 'active')->dropDownList(
    [1=>'Yes',0=>'No'],['prompt'=>'--Please select--']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
