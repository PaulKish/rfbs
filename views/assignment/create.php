<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\assignment */

$this->title = 'Create Assignment';
$this->params['breadcrumbs'][] = ['label' => 'Assignments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <hr>

    <?= $this->render('_form', [
        'model' => $model,
        'types' => $types,
        'roles' => $roles
    ]) ?>

</div>
