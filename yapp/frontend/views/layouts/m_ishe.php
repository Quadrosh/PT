<?php

/* @var $article \common\models\Article */
/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\MsheAsset;
use common\widgets\Alert;

MsheAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Tinos" rel="stylesheet">
<!--    <link rel="apple-touch-icon" href="/favicon/apple-touch-icon.png">-->
<!--    <link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-touch-icon-72x72.png">-->
<!--    <link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-touch-icon-114x114.png">-->
<!--    <link rel="apple-touch-icon" sizes="256x256" href="/favicon/apple-touch-icon-256x256.png">-->
    <?= Html::csrfMetaTags() ?>

    <title> <?= Yii::$app->view->params['title'] ?> </title>
    <meta name="description" content="<?= Yii::$app->view->params['description'] ?>">
    <meta name="keywords" content="<?= Yii::$app->view->params['keywords'] ?>">

    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="Айгуль Ше" />
    <meta property="og:title" content="<?= Yii::$app->view->params['meta']['title'] ?>" />
    <meta property="og:description" content="<?= Yii::$app->view->params['meta']['description'] ?>" />
    <meta property="og:url" content="<?= yii\helpers\Url::current(['lg'=>null], true) ?>" />
    <meta property="og:image" content="<?= yii\helpers\Url::base(true) ?>/img/ishe_square.jpg" />

    <?php $this->head() ?>
</head>
<body >
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => ' Психотерапевт / Иваново / Айгуль Ше',
        'brandUrl' => '/she',
        'options' => [
            'class' => 'navbar-inverse navbar-top navbar navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        [
            'label' => 'Главная',
            'url' => ['/she'],
            'active' =>  Yii::$app->request->url == '/she',
        ],
        [
            'label' => 'Обо мне',
            'url' => ['/she/about'],
            'active' => Yii::$app->request->url == '/she/about',
        ],
        [
            'label' => 'Философия',
            'url' => ['/she?#philosophy_section'],
            'active' => Yii::$app->request->url == '/she/philosophy',

        ],
//        [
//            'label' => 'Блог',
//            'url' => ['/she/blog'],
//            'active' => Yii::$app->request->url == '/she/blog',
//        ],
        [
            'label' => 'Записаться',
            'url' => ['/she/contact'],
            'active' => Yii::$app->request->url == '/she/contact',
            'linkOptions' => [
                'class' => 'contact_link',
            ],
        ],
    ];

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

        <div class="container-fluid no-gutters">


            <?= Alert::widget() ?>

            <?= $content ?>
        </div>

<!--    </section>-->

</div>



<footer class="footer">
    <div class="container">
        <p class="text-center"><?= Html::img('/img/pt_logo_glob_w.png',
                [
                    'class' => 'masterFooterPtLogo',
                    'alt' => 'Айгуль Ше - Психотерапевт Иваново, Москва - Psihotera.ru ',
                    'title'=>'Psihotera.ru',
                ]) ?> </p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
