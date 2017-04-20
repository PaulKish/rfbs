<?php 
	use yii\bootstrap\Nav;
?>
<?= Nav::widget([
        'options' => ['class' => 'nav-pills'],
        'items' => [
            ['label' => 'Assignment', 'url' => ['/assignment/index']],
			['label' => 'Category', 'url' => ['/category/index']],
			['label' => 'Role', 'url' => ['/role/index']],
			['label' => 'Type', 'url' => ['/type/index']],
        ],
    ]);
?>
<div class="clearfix"></div>