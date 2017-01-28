<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

// echo '<pre>', print_r($listDataProvider->getModels(), true), '</pre>'; exit();

$this->title = Yii::t('app', 'Books statistics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('app', 'statistics_main_text')?>
    </p></br>
	
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			// 'name',
			[
				'attribute'=>'name',
				'filter'=>false,
				'label'=>'<center>'.Yii::t('app', 'Region').'</center>',
				'encodeLabel' => false,
				'format' => 'raw',
			],
			[
				'attribute'=>'amount',
				'filter'=>false,
				'label'=>'<center>'.Yii::t('app', 'Amount').'</center>',
				'encodeLabel' => false,
				'format' => 'raw',
			],
			// 'amount',
			// 'region_id',
		],
	]); ?>
</div>
