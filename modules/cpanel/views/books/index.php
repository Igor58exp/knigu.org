<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

/* @var $searchModel app\modules\cpanel\models\BooksSearch */

$this->title = Yii::t('app', 'Books');
$this->params['breadcrumbs'][] = Yii::t('app', Yii::$app->controller->module->id);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Books'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
			
            'id',
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
            
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
