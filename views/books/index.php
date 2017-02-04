<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create book'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
            // 'id',
            'title',
            'author',
			'year',
            // 'hash',
			// 'user_id',
			// [
				// 'attribute'=>'user_id',
				// 'filter'=>$searchModel::getUsersList(),
				// 'value'=>function($data){
					// return $data::getUsersList()[$data->user_id];
				// }
			// ],
            [
				'attribute'=>'is_send',
				'filter'=>false,
				'label'=>'<center>'.Yii::t('app', 'Sent').'</center>',
				'encodeLabel' => false,
				'format' => 'raw',
				'value'=>function($data){
					return $data->recipients ? '<div class="glyphicon glyphicon-ok"></div>' : '<div class="glyphicon glyphicon-minus-sign"></div>';
				}
			],
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
