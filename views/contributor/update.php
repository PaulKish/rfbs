<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\contributor */

$this->title = 'Update Contributor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contributors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contributor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>

    <?= $this->render('_form', [
        'model' => $model,
        'countries' => $countries,
        'locations'=>$locations,
        'roles' => $roles
    ]) ?>

</div>
