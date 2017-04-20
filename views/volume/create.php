<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\volume */

$this->title = 'Create Volume';
$this->params['breadcrumbs'][] = ['label' => 'Volumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="volume-create">

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
