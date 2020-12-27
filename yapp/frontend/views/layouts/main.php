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
    <?= Html::csrfMetaTags() ?>
    <title><?= Yii::$app->view->params['title'] ?></title>
    <meta name="description" content="<?= Yii::$app->view->params['description'] ?>">
    <meta name="keywords" content="<?= Yii::$app->view->params['keywords'] ?>">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

    <?php $this->head() ?>
    <?php include_once("analytics_google.php") ?>
    <?php include_once("analytics_yandex.php") ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img class="brandLogo" src="/img/pt_logo_glob.png" class="pull-left"/>'.'<span class="brandName">Психотера</span>'.'<span class="brandMotto">все о психотерапии</span>',
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
            'active' => in_array(\Yii::$app->controller->id, ['article']),
        ],
        [
            'label' => 'Психотерапевты',
            'url' => ['/master'],
            'active' => in_array(\Yii::$app->controller->id, ['master']),

        ]
    ];
//    if (Yii::$app->user->isGuest) {
//        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
//        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
//    } else {
//        $menuItems[] = '<li>'
//            . Html::beginForm(['/site/logout'], 'post')
//            . Html::submitButton(
//                'Logout (' . Yii::$app->user->identity->username . ')',
//                ['class' => 'btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>';
//    }
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
</div>


<!--<div class="col-sm-12 text-center">-->
<!--    <p class="footer" >-->
<!--        --><?//= Yii::$app->name ?><!-- --><?//= date('Y') ?><!-- <br>-->
<!--        По всем вопросам, связанным с работой сайта <br>-->
<!--        обращайтесь на webmaster@psihotera.ru <br>-->
<!--        или по тел. +7 (985) 346-16-15-->
<!--    </p>-->
<!---->
<!--</div>-->

<footer class="footer">
    <div class="container text-center">
        <p > <?= Yii::$app->name ?> <?= date('Y') ?> <br>
            По всем вопросам, связанным с работой сайта <br>
            обращайтесь на webmaster@psihotera.ru <br>
            или по тел. +7 (985) 346-16-15
        </p>

    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
