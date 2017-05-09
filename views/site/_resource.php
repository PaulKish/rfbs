<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="report well">
    <h3><?= Html::encode($model->title) ?> <small>under <?= $model->category ?></small></h3>
    <small>
    	<i class="fa fa-clock-o"></i> posted <?= date('F j, Y, g:i a',strtotime($model->date)) ?>
    </small>

    <hr>
    <p><?= $model->content ?></p>

    <br>
    <?php if(isset($model->upload)): ?>
		<?= Html::a('<i class="fa fa-download"></i> Download',Url::to($model->getUploadUrl('upload')),['class'=>'btn btn-primary']) ?> 
	<?php endif; ?>
</div>