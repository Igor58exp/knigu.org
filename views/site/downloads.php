<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'Downloads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-downloads">
    <h1><?= Html::encode($this->title) ?></h1>
	<p>
		</br>
        <?= Yii::t('app', 'downloads_main_text'); ?>
	<p>
        <br>
	<?php
		echo ListView::widget([
			'dataProvider' => $listDataProvider,
			'itemView' => '_list',
		]);
	?>
	</br>
</div>
