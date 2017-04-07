<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Contribution - Update';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rfbs-form-update">
    <div class="pull-right">
        <?= $this->render('_menu') ?>
    </div>

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    
    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($gridModel as $index =>$model): ?>
            
        <?= $form->field($gridModel[$index], "[$index]volume")
            ->textInput(['maxlength' => true])
            ->label($model->type->type); 
            ?>

    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>