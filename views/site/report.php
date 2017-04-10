<?php
/* @var $this yii\web\View */
use app\models\Volume;
use yii\bootstrap\Nav; 
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;

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
			  		<?php $form = ActiveForm::begin([
			    		'layout' => 'inline',
			    	]); ?>
			    	<?= $form->field($model, 'date')->widget(DatePicker::classname(), [
				        'clientOptions' => [
				            'autoclose' => true,
				            'format' => 'yyyy-mm',
				            'startView' => 'months', 
				            'minViewMode' => 'months',
				            'class'=>''
				        ]
				    ]) ?>
				    <?= Html::submitButton('Filter', ['class' => 'btn btn-success']) ?>
				    <?php ActiveForm::end(); ?>

				    <hr>
				    
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
				    		<?php 
								$strategic = Volume::typeVolume(1,$product,$date);
								$commercial = Volume::typeVolume(2,$product,$date);
								$stock_reserve = $strategic + $commercial;

								$household = Volume::typeVolume(3,$product,$date);
								$processors = Volume::typeVolume(4,$product,$date);
								$warehouses = Volume::typeVolume(5,$product,$date);
								$relief = Volume::typeVolume(6,$product,$date);
								$stock = $strategic + $commercial + $household + $processors + $warehouses + $relief;

								$eac = Volume::typeVolume(7,$product,$date);
								$comesa = Volume::typeVolume(8,$product,$date);
								$world = Volume::typeVolume(9,$product,$date);
								$import = $eac + $comesa + $world;

								$production = Volume::typeVolume(10,$product,$date);
								$loss = Volume::typeVolume(11,$product,$date);
							?>


				    		<?= $this->render('_supply',[
				    			'strategic'		=>$strategic,
								'commercial'	=>$commercial,
								'stock_reserve'	=>$stock_reserve,
								'household'		=>$household,
								'processors'	=>$processors,
								'warehouses'	=>$warehouses,
								'relief'		=>$relief,
								'stock'			=>$stock,
								'eac'			=>$eac,
								'comesa'		=>$comesa,
								'world'			=>$world,
								'import'		=>$import,
								'production'	=>$production,
								'loss'			=>$loss
				    		]) ?>

				    		<?php 
				    			$total_stock = ($stock + $import + $production) - $loss;  
								$national = Volume::typeVolume(12,$product,$date);
								$seed = Volume::typeVolume(13,$product,$date);
								$feed = Volume::typeVolume(14,$product,$date);
								$industrial = Volume::typeVolume(15,$product,$date);

								$export_eac = Volume::typeVolume(16,$product,$date);
								$export_comesa = Volume::typeVolume(17,$product,$date);
								$export_world = Volume::typeVolume(18,$product,$date);
								$export = $export_eac + $export_comesa + $export_world;

								$available_stock = $stock - ($national + $seed + $feed + $industrial + $export);
							?>

				    		<?= $this->render('_utilization',[
				    			'total_stock' 		=> $total_stock,
				    			'national'			=> $national,
								'seed'				=> $seed,
								'feed'				=> $feed,
								'industrial'		=> $industrial,
								'export_eac'		=> $export_eac,
								'export_comesa'		=> $export_comesa,
								'export_world'		=> $export_world,
								'export'			=> $export,
								'available_stock'	=> $available_stock
				    		]) ?>

				    	</div>

				    	<?php foreach($countries as $country): ?>
				    	<div role="tabpanel" class="tab-pane" id="<?= $country->country; ?>">
				    		<?php 
				    			$strategic = Volume::typeVolume(1,$product,$date,$country->id);
								$commercial = Volume::typeVolume(2,$product,$date,$country->id);
								$stock_reserve = $strategic + $commercial;

								$household = Volume::typeVolume(3,$product,$date,$country->id);
								$processors = Volume::typeVolume(4,$product,$date,$country->id);
								$warehouses = Volume::typeVolume(5,$product,$date,$country->id);
								$relief = Volume::typeVolume(6,$product,$date,$country->id);
								$stock = $strategic + $commercial + $household + $processors + $warehouses + $relief;

								$eac = Volume::typeVolume(7,$product,$date,$country->id);
								$comesa = Volume::typeVolume(8,$product,$date,$country->id);
								$world = Volume::typeVolume(9,$product,$date,$country->id);
								$import = $eac + $comesa + $world;

								$production = Volume::typeVolume(10,$product,$date,$country->id);
								$loss = Volume::typeVolume(11,$product,$date,$country->id);
				    		?>

				    		<?= $this->render('_supply',[
				    			'strategic'		=>$strategic,
								'commercial'	=>$commercial,
								'stock_reserve'	=>$stock_reserve,
								'household'		=>$household,
								'processors'	=>$processors,
								'warehouses'	=>$warehouses,
								'relief'		=>$relief,
								'stock'			=>$stock,
								'eac'			=>$eac,
								'comesa'		=>$comesa,
								'world'			=>$world,
								'import'		=>$import,
								'production'	=>$production,
								'loss'			=>$loss
				    		]) ?>

				    		<?php 
				    			$total_stock = ($stock + $import + $production) - $loss;  
								$national = Volume::typeVolume(12,$product,$date,$country->id);
								$seed = Volume::typeVolume(13,$product,$date,$country->id);
								$feed = Volume::typeVolume(14,$product,$date,$country->id);
								$industrial = Volume::typeVolume(15,$product,$date,$country->id);

								$export_eac = Volume::typeVolume(16,$product,$date,$country->id);
								$export_comesa = Volume::typeVolume(17,$product,$date,$country->id);
								$export_world = Volume::typeVolume(18,$product,$date,$country->id);
								$export = $export_eac + $export_comesa + $export_world;

								$available_stock = $stock - ($national + $seed + $feed + $industrial + $export);
							?>

				    		<?= $this->render('_utilization',[
				    			'total_stock' 		=> $total_stock,
				    			'national'			=> $national,
								'seed'				=> $seed,
								'feed'				=> $feed,
								'industrial'		=> $industrial,
								'export_eac'		=> $export_eac,
								'export_comesa'		=> $export_comesa,
								'export_world'		=> $export_world,
								'export'			=> $export,
								'available_stock'	=> $available_stock
				    		]) ?>
				    	</div>
				    	<?php endforeach; ?>
				  	</div>
			  	</div>
			</div>
    	</div>
    </div>
</div>
