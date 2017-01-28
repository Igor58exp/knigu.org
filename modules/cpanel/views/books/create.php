<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

/* @var $model app\modules\cpanel\models\Books */

$this->title = Yii::t('app', 'Create Books');
$this->params['breadcrumbs'][] = Yii::t('app', Yii::$app->controller->module->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Books'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
