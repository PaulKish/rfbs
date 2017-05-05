<?php

/* @var $this yii\web\View */
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Volume;
use yii\web\View;

$this->title = 'Regional Food Balance Sheet';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Regional Food Balance Sheet</h1>

        <p class="lead"> by EAGC</p>

        <p>This Website allows grain stakeholders to access information on staple foods supply and utilization in the region for policy advisory, trade linkage information based on food supply and food security</p>

        <p><a class="btn btn-lg btn-success" href="#">Get started</a></p>
    </div>

    <hr>


    <div class="pull-right">
	    <?php $form = ActiveForm::begin([
			'layout' => 'inline',
			'method' => 'GET',
			'action' => '/site/index'
		]); ?>
		<?= $form->field($model, 'country')->dropDownList(
		$countries,['prompt'=>'Regional']) ?>
	    <?= Html::submitButton('Filter', ['class' => 'btn btn-success']) ?>
	    <?php ActiveForm::end(); ?>
    </div>
    
    <h2>Reports</h2>

    <hr>

    <div class="row">
    	<div class="col-md-6">
    		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Supply/Utilization (MT)</h3>
			  	</div>
			  	<div class="panel-body">
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
											            'y' => (float) Volume::catVolume(2,$key,$model->date,$model->country) // 2 is supply
											        ],
											        [
											            'name' => 'Utilization',
											            'y' => (float) Volume::catVolume(1,$key,$model->date,$model->country) // 1 is utilization
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
			  	<div class="panel-footer">
			  		<?= Html::a('See more',Url::to(['site/surplus-deficit-report'])) ?>
			  	</div>
			</div>
    	</div>
    	<div class="col-md-6">
    		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Surplus/Deficit (MT)</h3>
			  	</div>
			  	<div class="panel-body">
			    	<table class="table table-bordered">
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
			  	<div class="panel-footer">
			  		<?= Html::a('See more',Url::to(['site/surplus-deficit-report'])) ?>
			  	</div>
			</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-6">
    		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Tradeable Stock (MT)</h3>
			  	</div>
			  	<div class="panel-body">
			  		<table class="table table-bordered">
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
			  	<div class="panel-footer">
			  		<?= Html::a('See more',Url::to(['site/tradeable-stock-report'])) ?>
			  	</div>
			</div>
		</div>
		<div class="col-md-6">
    		<div class="panel panel-primary">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Production Estimates (MT)</h3>
			  	</div>
			  	<div class="panel-body">
			  		<table class="table table-bordered">
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
			  	<div class="panel-footer">
			  		<?= Html::a('See more',Url::to(['site/production-estimate-report'])) ?>
			  	</div>
			</div>
		</div>
    </div>

    <div class="row">
    	<div class="col-md-6">
		    <h2>Partners</h2>
		    <hr>

		    <div id="carousel-partners" class="carousel slide" data-ride="carousel" data-interval="5000">
			  	<!-- Wrapper for slides -->
			  	<div class="carousel-inner" role="listbox" style="height: 140px;">
			    	<div class="item active">
			    		<?= Html::img('@web/img/eagc_logo.png'); ?>
			    	</div>
			    	<div class="item">
			    		<?= Html::img('@web/img/wfp.png'); ?>
			    	</div>
			    	<div class="item">
			    		<?= Html::img('@web/img/eac_logo.png'); ?>
			    	</div>
			  	</div>
			</div>
		</div>
		<div class="col-md-6">
			<h2>Contact</h2>
			<hr>
			
	        <address>
				Mbaazi Avenue, Off Kingara Road <br>
				P.O Box 218-00606 Nairobi, Kenya <br>
				Tel: +254 20 3745840/ 37560636/7 <br>
				Mobile: +254 710 607 313/ +254 733 444 035 <br>
				Fax: +254 20 3745841, Secretariat <br>
				Email: <?= Html::mailto('rfbs@eagc.org') ?> 
	    	</address>
		</div>
	</div>



</div>
<?php
$script = <<< JS
    $('#commodities a:first').tab('show');
JS;
$this->registerJs($script,View::POS_END);