<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="item" data-key="<?= $model->id; ?>">
    <h2 class="title">
    <?= Html::a(Html::encode($model->email), Url::toRoute(['users/view', 'id' => $model->id]), ['email' => $model->email]) ?>
    </h2>

    <div class="item-name">
    <?= Html::encode($model->name); ?>
    </div>
</div>

