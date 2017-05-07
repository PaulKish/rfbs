<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="report">
    <h3><?= Html::encode($model->title) ?></h3>
    <small><i class="fa fa-clock-o"></i> posted <?= date('F j, Y, g:i a',strtotime($model->date)) ?></small>
    <br>
    <br>
	<?= Html::a('<i class="fa fa-download"></i> Download',Url::to($model->getUploadUrl('upload')),['class'=>'btn btn-primary']) ?> 
	<hr> 
</div>