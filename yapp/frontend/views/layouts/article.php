<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
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
    <link href="https://fonts.googleapis.com/css?family=Tinos" rel="stylesheet">
    <link rel="apple-touch-icon" href="/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="256x256" href="/favicon/apple-touch-icon-256x256.png">
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->view->params['title'] ?></title>
    <meta name="description" content="<?= Yii::$app->view->params['description'] ?>">
    <meta name="keywords" content="<?= Yii::$app->view->params['keywords'] ?>">
    <?php $this->head() ?>
    <?php include_once("analytics_google.php") ?>
    <?php include_once("analytics_yandex.php") ?>

</head>
<body>
<?php $this->beginBody() ?>

<div class="articleWrap ">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="brandLogo" src="/img/pt_logo_glob_w.png" class="pull-left"/>'.'<span class="brandName">Психотера</span>'.'<span class="brandMotto">все о психотерапии</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-top',
        ],
    ]);
    $menuItems = [
        [
            'label' => 'Главная',
            'url' => ['/'],
            'active' => in_array(\Yii::$app->controller->id, ['site']),
        ],
        [
            'label' => 'Статьи',
            'url' => ['/article'],
            'active' => strpos(Yii::$app->request->url,'/article')!==false,
        ],
        [
            'label' => 'Психотерапевты',
            'url' => ['/master'],
            'active' =>strpos(Yii::$app->request->url,'/master')!==false,

        ]
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
    <?= $this->render('/layouts/footer', []) ?>
</div>




<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
