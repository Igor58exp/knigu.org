<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="item" data-key="<?= $model['link']; ?>">
    <h2 class="title">
    <?= Html::a(Html::encode($model['title']), Url::toRoute([Yii::$app->request->baseUrl . "/downloads/" . $model['link']])) ?>
    </h2>

    <div class="item-name">
    <?= Html::encode($model->name); ?>
    </div>
</div>

