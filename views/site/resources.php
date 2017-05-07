<?php
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Resources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">

	<div class="panel panel-primary">
	  	<div class="panel-heading">
	    	<h3 class="panel-title"><?= $this->title ?></h3>
	  	</div>
	  	<div class="panel-body">
		    <?= ListView::widget([
			    'dataProvider' => $dataProvider,
			    'layout' => "{items}\n{pager}",
			    'itemView' => '_resource',
			]); ?>
		</div>
	</div>
</div>