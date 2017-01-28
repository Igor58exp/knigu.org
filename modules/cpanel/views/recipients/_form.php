<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\modules\cpanel\models\Countries;
use app\modules\cpanel\models\Regions;

/* @var $this yii\web\View */
/* @var $model app\modules\cpanel\models\Recipients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recipients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country_id')->dropDownList(Countries::getList()) ?>
	
	<?= $form->field($model, 'region_id')->dropDownList(Regions::getList()) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'is_pickup')->checkbox(['uncheck' => 0, 'value' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
