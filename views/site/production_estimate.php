<?php

/* @var $this yii\web\View */
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Volume;
use yii\web\View;
use dosamigos\datepicker\DateRangePicker;
use miloschuman\highcharts\Highcharts;

$this->title = 'Production Estimate Report';
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
						'action' => '/site/production-estimate-report'
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
						        'table' => 'production-estimate-report-'.$model->date.'-'.$model->end_date
						    ],
					   		'chart' => [
						        'type' =>'column',
						       	'height' => 290,
						    ],
					      	'title' => ['text'=>'Production Estimate Report'],
					      	'yAxis' => [
						      	'title' => [
						         	'text' => 'Volume (MT)'
						      	]
						   	],
					      	'credits'=> false
					   	]
					]); ?>

				    <table id="production-estimate-report-<?= $model->date ?>-<?= $model->end_date ?>" class="table table-bordered">
			    		<thead>
			    			<tr>
				    			<th>Commodity</th>
				    			<th class="text-right">Production Estimate</th>
				    			<th class="text-right">Post-harvest Loss</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php foreach($commodities as $key => $value): ?>
			    			<?php 
		    					$production = Volume::typeVolume(10,$key,$model->date,$model->end_date,$model->country);
		    					$loss = Volume::typeVolume(11,$key,$model->date,$model->end_date,$model->country);
		    				?>
			    			<tr>
			    				
			    				<th><?= $value ?></th>
			    				<td class="text-right"><?= $production ?></td>
			    				<td class="text-right"><?= $loss ?></td>
			    			</tr>
			    			<?php endforeach; ?>
			    		</tbody>
			    	</table>
			  		
			  	</div>
			</div>
    	</div>
    </div>
</div>