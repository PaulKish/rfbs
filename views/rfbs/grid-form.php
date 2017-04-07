<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'RFBS - Create Contribution';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rfbs-form">
<?= $this->render('_menu') ?>
    
    <?php $form = ActiveForm::begin(); ?>

    <?php $count = 0; ?>
    <?php foreach ($assignments as $assignment): ?>
        <?php $type = $assignment->type ?>

        <?= $form->field($gridModel[$count], "[$count]volume")
            ->textInput(['maxlength' => true])
            ->label($type->type) ?>

        <?= $form->field($gridModel[$count], "[$count]type_id")
            ->hiddenInput(['value'=>$type->id])
            ->label(false) ?>

        <?php $count++ ?>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>