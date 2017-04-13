<?php
/* @var $this yii\web\View */
use app\models\Volume;
use yii\bootstrap\Nav; 
use yii\bootstrap\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
use yii\web\View;

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
					<ul id="countries" class="nav nav-tabs" role="tablist">
					    <?php foreach($countries as $key => $country): ?>
					    <li role="presentation">
					    	<a href="#<?= $country; ?>" aria-controls="<?= $key; ?>" role="tab" data-toggle="tab"><?= $country; ?></a>
					    </li>
					    <?php endforeach; ?>
					</ul>

				  	<!-- Tab panes -->
				  	<div class="tab-content">
				    	<?php foreach($countries as $key => $country): ?>
				    	<div role="tabpanel" class="tab-pane" id="<?= $country; ?>">
				    		<?php 
				    			$strategic = Volume::typeVolume(1,$model->commodity,$model->date,$key);
								$commercial = Volume::typeVolume(2,$model->commodity,$model->date,$key);
								$stock_reserve = \Yii::$app->formatter->asDecimal($strategic + $commercial,2);

								$household = Volume::typeVolume(3,$model->commodity,$model->date,$key);
								$processors = Volume::typeVolume(4,$model->commodity,$model->date,$key);
								$warehouses = Volume::typeVolume(5,$model->commodity,$model->date,$key);
								$relief = Volume::typeVolume(6,$model->commodity,$model->date,$key);
								$stock = \Yii::$app->formatter->asDecimal($strategic + $commercial + $household + $processors + $warehouses + $relief,2);

								$eac = Volume::typeVolume(7,$model->commodity,$model->date,$key);
								$comesa = Volume::typeVolume(8,$model->commodity,$model->date,$key);
								$world = Volume::typeVolume(9,$model->commodity,$model->date,$key);
								$import = \Yii::$app->formatter->asDecimal($eac + $comesa + $world,2);

								$production = Volume::typeVolume(10,$model->commodity,$model->date,$key);
								$loss = Volume::typeVolume(11,$model->commodity,$model->date,$key);
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
								$national = Volume::typeVolume(12,$model->commodity,$model->date,$key);
								$seed = Volume::typeVolume(13,$model->commodity,$model->date,$key);
								$feed = Volume::typeVolume(14,$model->commodity,$model->date,$key);
								$industrial = Volume::typeVolume(15,$model->commodity,$model->date,$key);

								$export_eac = Volume::typeVolume(16,$model->commodity,$model->date,$key);
								$export_comesa = Volume::typeVolume(17,$model->commodity,$model->date,$key);
								$export_world = Volume::typeVolume(18,$model->commodity,$model->date,$key);
								$export = \Yii::$app->formatter->asDecimal($export_eac + $export_comesa + $export_world,2);

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
				    	<?php endforeach; ?>
				  	</div>
			  	</div>
			</div>
    	</div>
    </div>
</div>
<?php
$script = <<< JS
    $('#countries a:first').tab('show');
JS;
$this->registerJs($script,View::POS_END);