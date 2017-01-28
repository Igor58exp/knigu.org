<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Users;
use app\models\Books;
use app\models\SentBooks;

/* @var $this yii\web\View */
/* @var $model app\models\Recipients */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recipients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipients-view">

	<?php if (Yii::$app->session->hasFlash('book_is_send_successfully')): ?>
		<div class="alert alert-success">
			Thank you for sending.
		</div>
	<?php else: ?>

		<h1><?= Html::encode($this->title) ?></h1>
		
		
		<p>
			</br>
		</p>

		<?= DetailView::widget([
			'model' => $model,
			'attributes' => [
				'id',
				'name:ntext',
				// 'country_id',
				// 'country.name',
				[
					'label' => Yii::t('app', 'Country'),
					'value' => $model->country->name,
				],
				// 'region_id',
				// 'region.name',
				[
					'label' => Yii::t('app', 'Region'),
					'value' => $model->region->name,
				],
				'address:ntext',
				'is_pickup',
				// 'created_at',
				// 'updated_at',
			],
		]) ?>
		
		<div class="books-form">

			<?php $form = ActiveForm::begin(['action' =>['books/send'], 'method' => 'post']);?>
			<?= Html::hiddenInput('recipient_id', $model->id); ?>
			<?= Html::ul(Users::find()->with('books')->where(['id' => Yii::$app->getUser()->id])->one()->books, ['item' => function($book, $index) {
				return $this->render('_list', ['book' => $book]);
			}]) ?>
			
			<div class="form-group">
				<?= Html::submitButton(Yii::t('app', 'Send'), ['class' => 'btn btn-primary']) ?>
			</div>

			<?php ActiveForm::end(); ?>

		</div>
	
	<?php endif; ?>

</div>
