<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::t('app', 'My Company'),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']], 
            ['label' => Yii::t('app', 'Downloads'), 'url' => ['/site/downloads']], 
            ['label' => Yii::t('app', 'Bookworld'), 'url' => ['/site/statistics']], 
            Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']] 
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->email . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            ),
			Yii::$app->user->isGuest ? (
                ['label' => Yii::t('app', 'Sign up'), 'url' => ['/site/signup']]
            ) : (
                [
					'label' => Yii::t('app', 'My Account'),
					'items' => [
						['label' => Yii::t('app', 'Profile'), 'url' => ['/user/profile']],
						['label' => Yii::t('app', 'Change password'), 'url' => ['/user/changepassword']],
						// ['label' => Yii::t('app', 'Reset password'), 'url' => ['/user/resetpassword']],
						'<li class="divider"></li>',
						'<li class="dropdown-header"></li>',
						['label' => Yii::t('app', 'My Books'), 'url' => ['/books/index']],
					],
				]
                
            ),
			
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
