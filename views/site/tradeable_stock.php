<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Volume;
use yii\web\View;
use dosamigos\datepicker\DateRangePicker;
use miloschuman\highcharts\Highcharts;

$this->title = 'Tradeable Stock Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-surplus-deficit">
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title"><?= $this->title ?> (MT)</h3>
			  	</div>
			  	<div class="panel-body">
			  		<?php $form = ActiveForm::begin([
						'layout' => 'inline',
						'method' => 'GET',
						'action' => '/site/tradeable-stock-report'
					]); ?>

					<?= $form->field($model, 'country')->dropDownList(
						$countries,['prompt'=>'Regional']) ?>

					<?= $form->field($model, 'date')->widget(DateRangePicker::classname(), [
						'attributeTo' => 'end_date', 
						'form' => $form,
				        'clientOptions' => [
				            'autoclose' => true,
				            'format' => 'yyyy-mm-dd',
				            'endDate' => '+0d'
				        ]
				    ]) ?>
					
				    <?= Html::submitButton('Filter', ['class' => 'btn btn-success']) ?>

				    <?php ActiveForm::end(); ?>

				    <hr>

				    <?= Highcharts::widget([
				    	'scripts' => [
					        'modules/data',
					    ],
					   	'options' => [
					   		'data' => [
						        'table' => 'tradeable-stock-report-'.$model->date.'-'.$model->end_date
						    ],
					   		'chart' => [
						        'type' =>'column',
						       	'height' => 290,
						    ],
					      	'title' => ['text'=>'Tradeable Stock Report'],
					      	'yAxis' => [
						      	'title' => [
						         	'text' => 'Volume (MT)'
						      	]
						   	],
					      	'credits'=> false
					   	]
					]); ?>

				    <table id="tradeable-stock-report-<?= $model->date ?>-<?= $model->end_date ?>" class="table table-bordered table-export">
			    		<thead>
			    			<tr>
				    			<th>Commodity</th>
				    			<th class="text-right">Government</th>
				    			<th class="text-right">Warehouse</th>
				    			<th class="text-right">Processors</th>
				    			<th class="text-right">Total</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php foreach($commodities as $key => $value): ?>
			    			<?php 
		    					$commercial = Volume::typeVolume(2,$key,$model->date,$model->end_date,$model->country);
		    					$processors = Volume::typeVolume(4,$key,$model->date,$model->end_date,$model->country);
								$warehouses = Volume::typeVolume(5,$key,$model->date,$model->end_date,$model->country);
								$total = \Yii::$app->formatter->asDecimal($commercial + $processors + $warehouses,2);
		    				?>
			    			<tr>	
			    				<th><?= $value ?></th>
			    				<td class="text-right"><?= $commercial ?></td>
			    				<td class="text-right"><?= $warehouses ?></td>
			    				<td class="text-right"><?= $processors ?></td>
			    				<td class="text-right"><?= $total ?></td>
			    			</tr>
			    			<?php endforeach; ?>
			    		</tbody>
			    	</table>
			  		
			  	</div>
			</div>
    	</div>
    </div>
</div>