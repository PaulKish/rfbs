<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\commodity */

$this->title = 'Update Commodity: ' . $model->commodity;
$this->params['breadcrumbs'][] = ['label' => 'Commodities', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->commodity, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="commodity-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
