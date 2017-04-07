<?php 
	use yii\bootstrap\Nav;
?>
<?= Nav::widget([
        'options' => ['class' => 'nav-pills navbar-right'],
        'items' => [
        	['label' => 'RFBS', 'url' => ['/rfbs/index']],
            ['label' => 'Grid', 'url' => ['/rfbs/grid']],
            ['label' => 'Generate', 'url' => ['/rfbs/generate']],
        ],
    ]);
?>
<div class="clearfix"></div>
<hr>