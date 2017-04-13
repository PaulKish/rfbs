<?php

/* @var $this yii\web\View */
use miloschuman\highcharts\Highcharts;
use yii\web\JsExpression;

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

    <h1>Reports</h1>

    <hr>

    <div class="row">
    	<div class="col-md-6">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Domestic Supply</h3>
			  	</div>
			  	<div class="panel-body">
			    	<?= Highcharts::widget([
			    		'scripts' => [
					        'modules/exporting',
					        //'themes/grid-light',
					    ],
					   'options' => [
					   		'chart' => [
						        'type' =>'pie'
						    ],
					      	'title' => ['text' => 'Domestic Supply'],
					      	'plotOptions' => [
						        'pie' => [
						            'allowPointSelect' => true,
						            'cursor' => 'pointer',
						            'dataLabels' => [
					                    'enabled' => false
					                ],
						        ]
						    ],
						    'tooltip' => [
					            'pointFormat' => '{series.name}: <b>{point.y} MT</b>'
					        ],
					      	'series' => [
						        [
					                'name' => 'Volume',
					                'data' => $supply,
					            ],
					      	]
					   	]
					]); ?>
			  	</div>
			</div>
    	</div>
    	<div class="col-md-6">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Domestic Utilization</h3>
			  	</div>
			  	<div class="panel-body">
			    	<?= Highcharts::widget([
			    		'scripts' => [
					        'modules/exporting',
					        'themes/grid-light',
					    ],
					   'options' => [
					   		'chart' => [
						        'type' =>'pie'
						    ],
					      	'title' => ['text' => 'Domestic Utilization'],
					      	'plotOptions' => [
						        'pie' => [
						            'allowPointSelect' => true,
						            'cursor' => 'pointer',
						            'dataLabels' => [
					                    'enabled' => false
					                ],
						        ]
						    ],
						    'tooltip' => [
					            'pointFormat' => '{series.name}: <b>{point.y} MT</b>'
					        ],
					      	'series' => [
						        [
					                'name' => 'Volume',
					                'data' => $utilization,
					            ],
					      	]
					   	]
					]); ?>
			  	</div>
			</div>
    	</div>
    </div>
</div>
