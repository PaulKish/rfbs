<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Report */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="report-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category')->dropDownList(
            [
                'Events'=>'Events',
                'Crop Calendar'=>'Crop Calendar',
                'Reports'=>'Reports'
            ],
            ['prompt'=>'--Please select--']
        ) ?>

    <?= $form->field($model, 'content')->textArea() ?>    

    <?= $form->field($model, 'upload')->fileInput() ?>

    <?php if(!$model->isNewRecord): ?>
        <?= Html::a('View Upload',Url::to($model->getUploadUrl('upload')),['class'=>'btn btn-default']) ?>
	<?php endif; ?>

    <?= $form->field($model, 'active')->dropDownList(
            [1=>'Yes',0=>'No'],
            ['prompt'=>'--Please select--']
        ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
