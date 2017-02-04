<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

/* @var $model app\modules\cpanel\models\Books */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

	<?= $form->field($model, 'year')->dropDownList($model::getYearsList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select year') . ' -- ']) ?>
	
	<?= $form->field($model, 'user_id')->dropDownList($model::getUsersList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select user') . ' -- ']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
