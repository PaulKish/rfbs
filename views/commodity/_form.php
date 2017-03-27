<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\commodity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="commodity-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'commodity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'active')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
