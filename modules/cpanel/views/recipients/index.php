<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use app\modules\cpanel\models\Countries;
use app\modules\cpanel\models\Regions;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cpanel\models\RecipientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Recipients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipients-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create recipient'), ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
