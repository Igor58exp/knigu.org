<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cpanel\models\Users */

$this->title = Yii::t('app', 'Create Users');
$this->params['breadcrumbs'][] = Yii::t('app', Yii::$app->controller->module->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
