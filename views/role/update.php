<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\role */

$this->title = 'Update Role: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="role-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
