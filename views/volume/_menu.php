<?php 
	use yii\bootstrap\Nav;
?>
<?= Nav::widget([
        'options' => ['class' => 'nav-pills'],
        'items' => [
        	['label' => 'Volume', 'url' => ['/volume/index']],
        	['label' => 'Contributions', 'url' => ['/rfbs/grid-update']],
            ['label' => 'Data Grid', 'url' => ['/rfbs/grid']],
        ],
    ]);
?>
<div class="clearfix"></div>