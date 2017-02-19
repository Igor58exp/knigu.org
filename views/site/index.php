<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Подари Книгу';
?>
	<div class="site-index">

		<div class="jumbotron">
			<h1><?= Yii::t('app', 'main_title')?></h1>

			<p class="lead"><?= Yii::t('app', 'main_sub_title')?></p>

			<p><?= Html::a(Yii::t('app', 'more_info_btn'), ['site/about', 'id' => $id], ['class' => 'btn btn-lg btn-success']) ?></p>
		</div>

		<div class="body-content">

			<div class="row">
				<div class="col-lg-4">
					<h2><?= Yii::t('app', 'heading_step_one')?></h2>

					<p>
						<?= Yii::t('app', 'text_step_one')?>
					</p>

					<p>
						<?= Html::a(Yii::t('app', 'step_one_btn'), ['books/create', 'id' => $id], ['class' => 'btn btn-default']) ?>
					</p>
				</div>
				<div class="col-lg-4">
					<h2><?= Yii::t('app', 'heading_step_two')?></h2>

					<p>
						<?= Yii::t('app', 'text_step_two')?>
					</p>

					<p>
						<?= Html::a(Yii::t('app', 'step_two_btn'), ['recipients/index', 'id' => $id], ['class' => 'btn btn-default']) ?>
					</p>
				</div>
				<div class="col-lg-4">
					<h2><?= Yii::t('app', 'heading_step_three')?></h2>

					<p>
						<?= Yii::t('app', 'text_step_three')?>
					</p>

					<p>
						<?= Html::a(Yii::t('app', 'step_three_btn'), ['books/search', 'id' => $id], ['class' => 'btn btn-default']) ?>
					</p>
					
				</div>
				<!-- <div class="center-block"><?= Yii::t('app', 'text_info')?></div> -->
			</div>
		</div>
    </div>
	
</div>
