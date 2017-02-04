<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Countries;
use app\models\Regions;

/* @var $this yii\web\View */
/* @var $model app\models\RecipientsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="recipients-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'country_id')->dropDownList(Countries::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select country') . ' -- ']) ?>
		
	<?= $form->field($model, 'region_id')->dropDownList(Regions::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select region') . ' -- ']) ?>

    <?= $form->field($model, 'is_pickup')->dropDownList($model::getPickupStatusesList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select status') . ' -- '])  ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
