<?php

/* @var $this yii\web\View */
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\models\Volume;
use yii\web\View;

$this->title = 'Regional Food Balance Sheet';
?>
<div class="site-index">

    <div class="jumbotron well">
        <h1>Regional Food Balance Sheet</h1>

        <p class="lead"> by EAGC</p>

        <p>This website allows the East African Community to access information about the staple foods produced and traded in the East African Community partner nations to enable and facilitate trade. </p>

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
    		<div class="panel panel-default">
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
									       	'width' => 500 
									    ],
								      	'title' => false,
								      	'plotOptions' => [
									        'pie' => [
									            'allowPointSelect' => true,
									            'cursor' => 'pointer',
									            'dataLabels' => [
								                    'enabled' => true
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
			</div>
    	</div>
    	<div class="col-md-6">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Surplus/Deficit (MT)</h3>
			  	</div>
			  	<div class="panel-body">
			    	<table class="table table-bordered">
			    		<thead>
			    			<th>Commodity</th>
			    			<th>Stock Available</th>
			    			<th>Utilization</th>
			    			<th>Surplus/Deficit</th>
			    		</thead>
			    		<tbody>
			    			<?php foreach($commodities as $key => $value): ?>
			    			<tr>
			    				<?php 
			    					$supply = Volume::catVolume(2,$key,$model->date,$model->country);
			    					$utilization = Volume::catVolume(1,$key,$model->date,$model->country);
			    					$suplus = ($supply - $utilization);
			    				?>
			    				<td><?= $value ?></td>
			    				<td><?= $supply ?></td>
			    				<td><?= $utilization ?></td>
			    				<td><?= $suplus ?></td>
			    			</tr>
			    			<?php endforeach; ?>
			    		</tbody>
			    	</table>
			  	</div>
			</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-6">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Tradeable Stock (MT)</h3>
			  	</div>
			  	<div class="panel-body">
			  		<table class="table table-bordered">
			    		<thead>
			    			<th>Commodity</th>
			    			<th>Government</th>
			    			<th>Warehouse</th>
			    			<th>Processors</th>
			    			<th>Total</th>
			    		</thead>
			    		<tbody>
			    			<?php foreach($commodities as $key => $value): ?>
			    			<?php 
		    					$commercial = Volume::typeVolume(2,$key,$model->date,$model->country);
		    					$processors = Volume::typeVolume(4,$key,$model->date,$model->country);
								$warehouses = Volume::typeVolume(5,$key,$model->date,$model->country);
								$total = $commercial + $processors + $warehouses;
		    				?>
			    			<tr>
			    				
			    				<td><?= $value ?></td>
			    				<td><?= $commercial ?></td>
			    				<td><?= $warehouses ?></td>
			    				<td><?= $processors ?></td>
			    				<td><?= $total ?></td>
			    			</tr>
			    			<?php endforeach; ?>
			    		</tbody>
			    	</table>
			  	</div>
			</div>
		</div>
		<div class="col-md-6">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Production Estimates (MT)</h3>
			  	</div>
			  	<div class="panel-body">
			  		<table class="table table-bordered">
			    		<thead>
			    			<th>Commodity</th>
			    			<th>Production Estimate</th>
			    			<th>Post-harvest Loss</th>
			    		</thead>
			    		<tbody>
			    			<?php foreach($commodities as $key => $value): ?>
			    			<?php 
		    					$production = Volume::typeVolume(10,$key,$model->date,$model->country);
		    					$loss = Volume::typeVolume(11,$key,$model->date,$model->country);
		    				?>
			    			<tr>
			    				
			    				<td><?= $value ?></td>
			    				<td><?= $production ?></td>
			    				<td><?= $loss ?></td>
			    			</tr>
			    			<?php endforeach; ?>
			    		</tbody>
			    	</table>
			  	</div>
			</div>
		</div>
    </div>

   
    <div class="row">
    	<div class="col-md-6">
    		<h2>Partners</h2>
    		<hr>

    		<?= Html::img('@web/img/eagc_logo.png'); ?>
    		<?= Html::img('@web/img/eac_logo.png',['height'=>'150px','class'=>'pull-right']); ?>
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