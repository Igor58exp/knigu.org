<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\modules\cpanel\models\Countries;
use app\modules\cpanel\models\Regions;

/* @var $this yii\web\View */
/* @var $model app\modules\cpanel\models\RecipientsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recipients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'country_id')->dropDownList(Countries::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select country') . ' -- ']) ?>
		
	<?= $form->field($model, 'region_id')->dropDownList(Regions::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select region') . ' -- ']) ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'is_pickup')->dropDownList($model::getPickupStatusesList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select status') . ' -- '])  ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
