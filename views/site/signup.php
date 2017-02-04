<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use app\models\Countries;
use app\models\Regions;

$this->title = Yii::t('app', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('signUpFormSubmitted')): ?>

        <div class="alert alert-success">
            <!-- Thank you for Registration. -->
			<?= Yii::t('app', 'thank_you_for_registration_text')?>
        </div>

    <?php else: ?>

        <p>
            </br><!-- Sign up with your email address -->
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

					<?= $form->field($model, 'country_id')->dropDownList(Countries::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select country') . ' -- ']) ?>
				
					<?= $form->field($model, 'region_id')->dropDownList(Regions::getList(), $params = ['prompt' => ' -- ' . Yii::t('app', 'Select region') . ' -- ']) ?>

					<?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

    <?php endif; ?>
</div>
