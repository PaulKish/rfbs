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
    	<div class="col-md-12">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Food Balance Sheet</h3>
			  	</div>
			  	<div class="panel-body">
			  		<?php $form = ActiveForm::begin([
			    		'layout' => 'inline',
			    	]); ?>
			    	<?= $form->field($model, 'commodity')->dropDownList(
    				$commodities,['prompt'=>'--Please select--']) ?>
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
								$strategic = Volume::typeVolume(1,$model->commodity,$model->date);
								$commercial = Volume::typeVolume(2,$model->commodity,$model->date);
								$stock_reserve = \Yii::$app->formatter->asDecimal($strategic + $commercial,2);

								$household = Volume::typeVolume(3,$model->commodity,$model->date);
								$processors = Volume::typeVolume(4,$model->commodity,$model->date);
								$warehouses = Volume::typeVolume(5,$model->commodity,$model->date);
								$relief = Volume::typeVolume(6,$model->commodity,$model->date);
								$stock = \Yii::$app->formatter->asDecimal($strategic + $commercial + $household + $processors + $warehouses + $relief,2);

								$eac = Volume::typeVolume(7,$model->commodity,$model->date);
								$comesa = Volume::typeVolume(8,$model->commodity,$model->date);
								$world = Volume::typeVolume(9,$model->commodity,$model->date);
								$import = \Yii::$app->formatter->asDecimal($eac + $comesa + $world,2);

								$production = Volume::typeVolume(10,$model->commodity,$model->date);
								$loss = Volume::typeVolume(11,$model->commodity,$model->date);
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
				    			$total_stock = \Yii::$app->formatter->asDecimal(($stock + $import + $production) - $loss,2);  
								$national = Volume::typeVolume(12,$model->commodity,$model->date);
								$seed = Volume::typeVolume(13,$model->commodity,$model->date);
								$feed = Volume::typeVolume(14,$model->commodity,$model->date);
								$industrial = Volume::typeVolume(15,$model->commodity,$model->date);

								$export_eac = Volume::typeVolume(16,$model->commodity,$model->date);
								$export_comesa = Volume::typeVolume(17,$model->commodity,$model->date);
								$export_world = Volume::typeVolume(18,$model->commodity,$model->date);
								$export = $export_eac + $export_comesa + $export_world;

								$available_stock = \Yii::$app->formatter->asDecimal($stock - ($national + $seed + $feed + $industrial + $export),2);
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
				    			$strategic = Volume::typeVolume(1,$model->commodity,$model->date,$country->id);
								$commercial = Volume::typeVolume(2,$model->commodity,$model->date,$country->id);
								$stock_reserve = $strategic + $commercial;

								$household = Volume::typeVolume(3,$model->commodity,$model->date,$country->id);
								$processors = Volume::typeVolume(4,$model->commodity,$model->date,$country->id);
								$warehouses = Volume::typeVolume(5,$model->commodity,$model->date,$country->id);
								$relief = Volume::typeVolume(6,$model->commodity,$model->date,$country->id);
								$stock = $strategic + $commercial + $household + $processors + $warehouses + $relief;

								$eac = Volume::typeVolume(7,$model->commodity,$model->date,$country->id);
								$comesa = Volume::typeVolume(8,$model->commodity,$model->date,$country->id);
								$world = Volume::typeVolume(9,$model->commodity,$model->date,$country->id);
								$import = $eac + $comesa + $world;

								$production = Volume::typeVolume(10,$model->commodity,$model->date,$country->id);
								$loss = Volume::typeVolume(11,$model->commodity,$model->date,$country->id);
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
								$national = Volume::typeVolume(12,$model->commodity,$model->date,$country->id);
								$seed = Volume::typeVolume(13,$model->commodity,$model->date,$country->id);
								$feed = Volume::typeVolume(14,$model->commodity,$model->date,$country->id);
								$industrial = Volume::typeVolume(15,$model->commodity,$model->date,$country->id);

								$export_eac = Volume::typeVolume(16,$model->commodity,$model->date,$country->id);
								$export_comesa = Volume::typeVolume(17,$model->commodity,$model->date,$country->id);
								$export_world = Volume::typeVolume(18,$model->commodity,$model->date,$country->id);
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
