<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Заявки',
            'items' => [
                ['label' => 'Заявки', 'url' => ['/feedback']],
                ['label' => 'Просмотры', 'url' => ['/count']],
                ['label' => 'С этим читают', 'url' => ['/read-with-it']],
            ],
        ],
        ['label' => 'Libs',
            'items' => [
                ['label' => 'Профессия', 'url' => ['/professionitem']],
                ['label' => 'Виды психотерапии', 'url' => ['/psychotherapyitem']],
                ['label' => 'Сайт', 'url' => ['/siteitem']],
                ['label' => 'Назначение', 'url' => ['/itemassign']],
                ['label' => 'Images', 'url' => ['/imagefiles']],
                ['label' => 'Цитаты', 'url' => ['/quote']],
                ['label' => 'Страницы Мастера', 'url' => ['/masterpageitem']],
                ['label' => 'кнопки Мастера', 'url' => ['/btnitem']],
                ['label' => 'Города', 'url' => ['/city-item']],
                ['label' => 'Типы сессий', 'url' => ['/session-type-item']],
            ],
        ],
        ['label' => 'Метки',
            'items' => [
                ['label' => 'Метки', 'url' => ['/tag']],
                ['label' => 'Назначение', 'url' => ['/tagassign']],
            ],
        ],
        ['label' => 'Психотерапевты', 'url' => ['/master']],
        ['label' => 'Статьи', 'url' => ['/article']],


//        ['label' => 'Статьи',
//            'items' => [
//                ['label' => 'Статьи', 'url' => ['/article']],
//                ['label' => 'Что то еще', 'url' => ['/#']],
//            ],
//        ],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
