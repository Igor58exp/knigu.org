<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\cpanel\models\Users */

$this->title = $model->name;
$this->params['breadcrumbs'][] = Yii::t('app', Yii::$app->controller->module->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
	
	<? //echo '<pre>', print_r($model->find()->with('country, region')->where(['id' => 1])->one(), true), '</pre>'?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'password',
            // 'country_id',
			// 'country.name',
			[
				'label' => 'Country',
				'value' => $model->country->name,
			],
            // 'region_id',
			// 'region.name',
			[
				'label' => 'Region',
				'value' => $model->region->name,
			],
            'email:email',
            'emailVerified:email',
            'verificationToken',
            'is_blocked',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
