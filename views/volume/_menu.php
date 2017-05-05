<?php 
	use yii\bootstrap\Nav;
?>
<?= Nav::widget([
        'options' => ['class' => 'nav-pills'],
        'items' => [
        	['label' => 'Volume', 'url' => ['/volume/index']],
        	['label' => 'Data Grid', 'url' => ['/rfbs/grid']],
        	['label' => 'Contributions', 'url' => ['/rfbs/grid-update']],
            ['label' => 'Contributor Report', 'url' => ['/rfbs/index']],
        ],
    ]);
?>
<div class="clearfix"></div>