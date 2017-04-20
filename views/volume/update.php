<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\volume */

$this->title = 'Update Volume: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Volumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="volume-update">

	<div class="pull-right">
        <?= $this->render('_menu') ?>
    </div>
    
    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
    
    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'commodities' => $commodities,
        'contributors' => $contributors
    ]) ?>

</div>
