<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\cpanel\models\Recipients */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Recipients',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recipients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="recipients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
