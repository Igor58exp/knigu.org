<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
// echo '<pre>' . print_r($book, true) . '</pre>';
?>

<?// = Html::checkbox('agree', true, ['label' => 'Send'])?></br>

<?/*= DetailView::widget([
	'model' => $book,
	'attributes' => [
		// 'id',
		// 'user_id',
		'title',
		'author',
		'hash',
		'year',
		// 'created_at',
		// 'updated_at',
	],
]) */?>

<div class="panel panel-default">
  <div class="panel-heading"><?= $book['title']?></br><?= $book['author']?></div>
  <div class="panel-body">
    <?= Html::checkbox('book_ids[]', false, ['value' => $book['id'], 'label' => Yii::t('app', 'Send book')])?>
  </div>
</div>
