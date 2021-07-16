<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

\frontend\assets\ArticleAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Tinos" rel="stylesheet">
    <link rel="apple-touch-icon" href="/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="256x256" href="/favicon/apple-touch-icon-256x256.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->view->params['title'] ?></title>
    <meta name="description" content="<?= Yii::$app->view->params['description'] ?>">
    <meta name="keywords" content="<?= Yii::$app->view->params['keywords'] ?>">

    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Психотера, все о психотерапии" />
    <meta property="og:title" content="<?= Yii::$app->view->params['title'] ?>" />
    <meta property="og:description" content="<?= Yii::$app->view->params['description'] ?>" />
    <meta property="og:url" content="<?= yii\helpers\Url::current(['lg'=>null], true) ?>" />
    <meta property="og:image" content="<?= yii\helpers\Url::base(true) ?>/img/pt_logo_glob_square.jpg" />


    <?php $this->head() ?>
    <?php if (Url::base('')=='//psihotera.ru') : ?>
        <?php include_once("analytics_google.php") ?>
        <?php include_once("analytics_yandex.php") ?>
    <?php endif; ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapBeforeFooter ">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="brandLogo" src="/img/pt_logo_glob_white_480.png" class="pull-left"/>'.'<span class="brandName">Психотера</span>'.'<span class="brandMotto">все о психотерапии</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-transparent navbar-absolute-top _navbar-top',
        ],
    ]);
    $menuItems = [
        [
            'label' => 'Главная',
            'url' => ['/'],
        ],
        [
            'label' => 'Статьи',
            'url' => ['/article'],
            'active' => strpos(Yii::$app->request->url,'/article')!==false,
        ],
        [
            'label' => 'Психотерапевты',
            'url' => ['/master'],
            'active' => strpos(Yii::$app->request->url,'/master')!==false,

        ]
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container-fluid no-gutters h100per">

        <?= Alert::widget() ?>

        <?= $content ?>
    </div>


</div>
<?= $this->render('/layouts/footer', []) ?>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
