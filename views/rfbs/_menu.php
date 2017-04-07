<?php 
	use yii\bootstrap\Nav;
?>
<?= Nav::widget([
        'options' => ['class' => 'nav-pills'],
        'items' => [
        	['label' => 'RFBS', 'url' => ['/rfbs/index']],
            ['label' => 'Data Grid', 'url' => ['/rfbs/grid']],
            ['label' => 'Contributions', 'url' => ['/rfbs/grid-update']],
            ['label' => 'Generate', 'url' => ['/rfbs/generate']],
        ],
    ]);
?>
<div class="clearfix"></div>
<hr>