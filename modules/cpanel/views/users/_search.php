<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Countries;
use app\models\Regions;

/* @var $this yii\web\View */
/* @var $model app\modules\cpanel\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php // echo $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'surname') ?>

    <?php // echo $form->field($model, 'password') ?>

	<?= $form->field($model, 'country_id')->dropDownList(Countries::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select country') . ' -- ']) ?>
	
	<?= $form->field($model, 'region_id')->dropDownList(Regions::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select region') . ' -- ']) ?>

    <?= $form->field($model, 'email') ?>
	
    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'emailVerified') ?>

    <?php // echo $form->field($model, 'verificationToken') ?>

    <?php // echo $form->field($model, 'is_blocked') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
