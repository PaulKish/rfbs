<?php

/* @var $this yii\web\View */
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Volume;
use yii\web\View;
use dosamigos\datepicker\DateRangePicker;

$this->title = 'Surplus Deficit Report';
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
						'action' => '/site/surplus-deficit-report'
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
						        'table' => 'surplus-deficit-report-'.$model->date.'-'.$model->end_date
						    ],
					   		'chart' => [
						        'type' =>'column',
						       	'height' => 290,
						    ],
					      	'title' => ['text'=>'Surplus Deficit Report'],
					      	'yAxis' => [
						      	'title' => [
						         	'text' => 'Volume (MT)'
						      	]
						   	],
					      	'credits'=> false
					   	]
					]); ?>

			  		<table id="surplus-deficit-report-<?= $model->date ?>-<?= $model->end_date ?>" class="table table-bordered table-export">
			    		<thead>
			    			<tr>
				    			<th>Commodity</th>
				    			<th class="text-right">Stock Available</th>
				    			<th class="text-right">Utilization</th>
				    			<th class="text-right">Surplus/Deficit</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php foreach($commodities as $key => $value): ?>
			    			<tr>
			    				<?php 
			    					$supply = Volume::catVolume(2,$key,$model->date,$model->end_date,$model->country);
			    					$utilization = Volume::catVolume(1,$key,$model->date,$model->end_date,$model->country);
			    					$surplus = \Yii::$app->formatter->asDecimal($supply - $utilization,2);
			    				?>
			    				<th><?= $value ?></th>
			    				<td class="text-right"><?= $supply ?></td>
			    				<td class="text-right"><?= $utilization ?></td>
			    				<td class="text-right"><?= $surplus ?></td>
			    			</tr>
			    			<?php endforeach; ?>
			    		</tbody>
			    	</table>
			  	</div>
			</div>
    	</div>
    </div>
</div>