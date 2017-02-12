<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

// echo '<pre>', print_r($model, true), '</pre>'; exit();
$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    </br><div class="books-search">

		<?php $form = ActiveForm::begin([
			'action' => ['search'],
			'method' => 'post',
		]); ?>
		
		<?= $form->field($model, 'hash') ?>

		<div class="form-group">
			<?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

	</div></br>

    <p>
        </br>
    </p>
<?php if (!empty($model->getAttribute('hash'))): ?>
	<?php Pjax::begin(); ?>
		<?php if (!empty($model->id)): ?>
		<h3><?= Yii::t('app', 'Book') ?></h3>
		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'title',
				'author',
				'hash',
				'year',
			],
		]) ?>
		<?php else: ?>
		<p>
			<div class="alert alert-info" role="alert">
				<?= Yii::t('app', 'book_with_current_code_is_not_registered') ?>
			</div>
		</p>
		<?php endif; ?></br>
		
		<?php if (!empty($model->user)): ?>
			<h3><?= Yii::t('app', 'User') ?></h3>
			<?= DetailView::widget([
				'model' => $model->user,
				'attributes' => [
					'name',
					'surname',
					'email:email',
				],
			]) ?>
		<?php endif; ?></br>
		
		<?php if (!empty($model->recipient)): ?>
			<h3><?= Yii::t('app', 'Recipient') ?></h3>
			<?= DetailView::widget([
				'model' => $model->recipient,
				'attributes' => [
					'name:ntext',
					'address:ntext',
				],
			]) ?>
		<?php endif;?>
	<?php Pjax::end(); ?>
<?php endif; ?></div>
