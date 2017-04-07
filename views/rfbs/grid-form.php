<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->title = 'RFBS - Grid';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rfbs-form">
<?= $this->render('_menu') ?>
    
    <?php $form = ActiveForm::begin(); ?>

    <?php
        $count = 0;
        // generate list of input boxes 
        foreach ($assignments as $assignment) {
            $type = $assignment->type; // label for generated field
            
            echo $form->field($gridModel[$count], "[$count]volume")->textInput(['maxlength' => true])->label($type->type);

            echo $form->field($gridModel[$count], "[$count]type_id")->hiddenInput(['value'=>$type->id])->label(false);

            $count++;
        }
        
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>