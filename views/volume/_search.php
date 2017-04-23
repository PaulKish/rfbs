<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VolumeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="volume-search">

    <?php $form = ActiveForm::begin([
        'layout' => 'inline',
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'user.organization')->textInput(['placeholder' => 'Organization']) ?>

    <?= $form->field($model, 'user.country.country')->textInput(['placeholder' => 'Country']) ?>

    <?= $form->field($model, 'product.commodity')->textInput(['placeholder' => 'Commodity']) ?>

    <?= $form->field($model, 'volume')->textInput(['placeholder' => 'Volume']) ?>

    <?= $form->field($model, 'type.type')->textInput(['placeholder' => 'Type']) ?>

    <?= $form->field($model, 'date')->textInput(['placeholder' => 'Date']) ?>

    <?= $form->field($model, 'active')->textInput(['placeholder' => 'Active']) ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
