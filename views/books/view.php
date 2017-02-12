<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>
	
	 <?php if (Yii::$app->session->hasFlash('resendStickerSuccessfully')): ?>

        <div class="alert alert-success">
			<?= Yii::t('app', 'resend_sticker_successfully')?>
        </div>

    <?php endif; ?>

    <p>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
		<?= Html::a(Yii::t('app', 'Resend sticker'), ['resendsticker', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'user_id',
            'title',
            'author',
            'hash',
            'year',
            'created_at',
            // 'updated_at',
        ],
    ]) ?>
	
	<p>
        <?= Html::a(Yii::t('app', 'Create book'), ['create'], ['class' => 'btn btn-success']) ?>
		<?= Html::a(Yii::t('app', 'step_two_btn'), ['recipients/index', 'id' => $id], ['class' => 'btn btn-primary']) ?>
    </p>

</div>
