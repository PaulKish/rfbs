<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\contributor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contributor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone')->textInput() ?>

    <?= $form->field($model, 'organization')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role_id')->dropDownList(
        $roles,['prompt'=>'--Please select--']) ?>

    <?= $form->field($model, 'country_id')->dropDownList(
        $countries,[
            'prompt'=>'--Please select--',
            'onchange'=>'
                $.post("/contributor/locations?id="+$(this).val(), 
                    function(data) {
                        $("#contributor-location_id").html(data);
                });'
        ]) ?>

    <?= $form->field($model, 'location_id')->dropDownList(
        $locations,['prompt'=>'--Please select--']) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd',
            'endDate' => '+0d'
        ]
    ]) ?>

    <?= $form->field($model, 'active')->dropDownList(
        [1=>'Yes',0=>'No'],['prompt'=>'--Please select--']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
