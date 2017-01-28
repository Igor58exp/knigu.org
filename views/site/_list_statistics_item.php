<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="item" data-key="<?= $model->region_id; ?>">
    <h2 class="title">
     <?= Html::encode($model->name); ?>
    </h2>

    <div class="item-name">
    <?= Html::encode($model->name); ?>
    </div>
</div>

