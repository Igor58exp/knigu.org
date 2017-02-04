<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\models\Countries;
use app\models\Regions;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RecipientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Recipients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // echo Html::a(Yii::t('app', 'Create recipient'), ['create'], ['class' => 'btn btn-success']) ?></br>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'name:ntext',
            // [
				// 'attribute'=>'country_id',
				// 'filter'=>Countries::getList(),
				// 'value'=>function($data){
					// return Countries::getList()[$data->country_id];
				// }
			// ],
			// [
				// 'attribute'=>'region_id',
				// 'filter'=>Regions::getList(),
				// 'value'=>function($data){
					// return Regions::getList()[$data->region_id];
				// }
			// ],
            'address:ntext',
            // 'is_pickup',
			// [
				// 'attribute'=>'is_pickup',
				// 'filter'=>$searchModel::getPickupStatusesList(),
				// 'value'=>function($data){
					// return $data::getPickupStatusesList()[$data->is_pickup];
				// }
			// ],
            // 'created_at',
            // 'updated_at',

            [
				'class' => 'yii\grid\ActionColumn',
				'template'=>'{send}',
				'buttons'=>[
					'send' => function ($url, $model) {     
						return Html::a('<span class="glyphicon glyphicon-log-out"></span>', $url, [
							'title' => Yii::t('yii', 'Send'),
						]);                              
					},
					'urlCreator'=>function($action, $model, $key, $index){
						return [$action,'id'=>$model->id,'hvost'=>time()];
					},
				] 
			],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
