<?php
use yii\bootstrap\Nav;
/* @var $this yii\web\View */

$this->title = 'Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-report">
	<div class="row">
    	<div class="col-md-3">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Commodities</h3>
			  	</div>
			  	<div class="panel-body">
			    	<?= Nav::widget([
					        'options' => ['class' => 'nav-pills nav-stacked'],
					        'items' => $menu,
					    ]);
					?>
			  	</div>
			</div>
    	</div>
    	<div class="col-md-9">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Food Balance Sheet</h3>
			  	</div>
			  	<div class="panel-body">
			  		<!-- Nav tabs -->

					<ul class="nav nav-tabs" role="tablist">
					    <li role="presentation" class="active">
					    	<a href="#regional" aria-controls="regional" role="tab" data-toggle="tab">Regional</a>
					    </li>
					    <?php foreach($countries as $country): ?>
					    <li role="presentation">
					    	<a href="#<?= $country->country; ?>" aria-controls="<?= $country->country; ?>" role="tab" data-toggle="tab"><?= $country->country; ?></a>
					    </li>
					    <?php endforeach; ?>
					</ul>

				  	<!-- Tab panes -->
				  	<div class="tab-content">
				    	<div role="tabpanel" class="tab-pane active" id="regional">

				    	</div>
				    	<?php foreach($countries as $country): ?>
				    	<div role="tabpanel" class="tab-pane" id="<?= $country->country; ?>">
				    		
				    	</div>
				    	<?php endforeach; ?>
				  	</div>
			  	</div>
			</div>
    	</div>
    </div>
</div>
