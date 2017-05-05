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

			  		<div class="row">
    					<div class="col-md-6">
					  		<!-- Nav tabs -->
							<ul id="commodities" class="nav nav-pills" role="tablist">
							    <?php foreach($commodities as $key => $value): ?>
							    <li role="presentation">
							    	<a href="#<?= $value; ?>" aria-controls="<?= $key; ?>" role="tab" data-toggle="tab"><?= $value; ?></a>
							    </li>
							    <?php endforeach; ?>
							</ul>

							<div class="tab-content">
						  		<?php foreach($commodities as $key => $value): ?>
							    	<div role="tabpanel" class="tab-pane" id="<?= $value; ?>">
							    		<?= Highcharts::widget([
										   'options' => [
										   		'chart' => [
											        'type' =>'pie',
											       	'height' => 290,
									       			'width' => 500 
											    ],
										      	'title' => false,
										      	'plotOptions' => [
											        'pie' => [
											            'allowPointSelect' => true,
											            'cursor' => 'pointer',
											            'dataLabels' => [
										                    'enabled' => false
										                ],
										                'showInLegend'=>true
											        ]
											    ],
											    'tooltip' => [
										            'pointFormat' => '{series.name}: <b>{point.y} MT</b>'
										        ],
										      	'series' => [
											        [
										                'name' => 'Volume',
										                'data' => [
										                	[
													            'name' => 'Supply',
													            'y' => (float) Volume::catVolume(2,$key,$model->date,$model->end_date,$model->country) // 2 is supply
													        ],
													        [
													            'name' => 'Utilization',
													            'y' => (float) Volume::catVolume(1,$key,$model->date,$model->end_date,$model->country) // 1 is utilization
													        ]
													    ]
										            ],
										      	],
										      	'credits'=> false
										   	]
										]); ?>
							    	</div>
								<?php endforeach; ?>
							</div>
						</div>

						<div class="col-md-6">
							<table id="surplus-deficit-report-<?= $model->date ?>-<?= $model->end_date ?>" class="table table-bordered table-export">
					    		<thead>
					    			<th>Commodity</th>
					    			<th class="text-right">Stock Available</th>
					    			<th class="text-right">Utilization</th>
					    			<th class="text-right">Surplus/Deficit</th>
					    		</thead>
					    		<tbody>
					    			<?php foreach($commodities as $key => $value): ?>
					    			<tr>
					    				<?php 
					    					$supply = Volume::catVolume(2,$key,$model->date,$model->end_date,$model->country);
					    					$utilization = Volume::catVolume(1,$key,$model->date,$model->end_date,$model->country);
					    					$surplus = \Yii::$app->formatter->asDecimal($supply - $utilization,2);
					    				?>
					    				<td><?= $value ?></td>
					    				<td class="text-right"><?= $supply ?></td>
					    				<td class="text-right"><?= $utilization ?></td>
					    				<td class="text-right"><strong><?= $surplus ?></strong></td>
					    			</tr>
					    			<?php endforeach; ?>
					    		</tbody>
					    	</table>
					    </div>
					</div>
			  	</div>
			</div>
    	</div>
    </div>
</div>
<?php
$script = <<< JS
    $('#commodities a:first').tab('show');
JS;
$this->registerJs($script,View::POS_END);