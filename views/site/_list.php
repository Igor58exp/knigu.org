<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="item" data-key="<?= $model['link']; ?>">
    <h4 class="title">
    <?= Html::a(Html::encode('"'.$model['title'].'" '.$model['author']), Url::toRoute([Yii::$app->request->baseUrl . "/downloads/" . $model['link']])) ?>
    </h4>

    <div class="item-name">
    <?= Html::encode($model->name); ?>
    </div>
</div>

