<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\jui\DatePicker;

use app\modules\cpanel\models\Countries;
use app\modules\cpanel\models\Regions;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\cpanel\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = Yii::t('app', Yii::$app->controller->module->id);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Users'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

				'id',
				'name',
				'surname',
				// 'password',
				[
					'attribute'=>'country_id',
					'filter'=>Countries::getList(),
					'value'=>function($data){
						return Countries::getList()[$data->country_id];
					}
				],
				[
					'attribute'=>'region_id',
					'filter'=>Regions::getList(),
					'value'=>function($data){
						return Regions::getList()[$data->region_id];
					}
				],
				'email:email',
				[
					'attribute'=>'emailVerified',
					'filter'=>$searchModel::getEmailVerifiedStatusesList(),
					'value'=>function($data){
						return $data::getEmailVerifiedStatusesList()[$data->emailVerified];
					}
				],
				// 'verificationToken',
				[
					'attribute'=>'is_blocked',
					'filter'=>$searchModel::getBlockedStatusesList(),
					'value'=>function($data){
						return $data::getBlockedStatusesList()[$data->is_blocked];
					}
				],
				// 'created_at:datetime',
				// [
					// 'attribute' => 'created_at',
					// 'value' => 'created_at',
					// 'filter' => \yii\jui\DatePicker::widget([
						// 'model'=>$searchModel,
						// 'attribute'=>'created_at',
						// 'language' => 'ru',
						// 'dateFormat' => 'dd-MM-yyyy',
					// ]),
					// 'format' => 'html',
				// ],
				// 'updated_at:datetime',

				['class' => 'yii\grid\ActionColumn'],
			],
		]); ?>
	<?php Pjax::end(); ?>
</div>
