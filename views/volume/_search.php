<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\VolumeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="volume-search">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
        'action' => ['index'],
        'method' => 'get',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-4',
                'offset' => 'col-sm-offset-2',
                'wrapper' => 'col-sm-6',
            ],
        ],
    ]); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'user.organization')->textInput(['placeholder' => 'Organization']) ?>
            <?= $form->field($model, 'user.country.country')->textInput(['placeholder' => 'Country']) ?>
            <?= $form->field($model, 'product.commodity')->textInput(['placeholder' => 'Commodity']) ?>
            <?= $form->field($model, 'volume')->textInput(['placeholder' => 'Volume']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'type.type')->textInput(['placeholder' => 'Type']) ?>
            <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd'
                ]
            ]) ?>
            <?= $form->field($model, 'active')->dropDownList([1=>'Yes',0=>'No']) ?>

            <div class="col-sm-6 col-sm-offset-4">
                <?= Html::submitButton('Search', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
        </div>
        
    </div>
    

    <?php ActiveForm::end(); ?>

</div>
