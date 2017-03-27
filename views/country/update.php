<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\country */

$this->title = 'Update Country: ' . $model->country;
$this->params['breadcrumbs'][] = ['label' => 'Countries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->country, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="country-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
