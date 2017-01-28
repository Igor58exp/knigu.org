<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\cpanel\models\Recipients */

$this->title = Yii::t('app', 'Create Recipients');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Recipients'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="recipients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
