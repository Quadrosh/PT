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

    <title> <?= Yii::$app->view->params['meta']['title'] ?> </title>
    <meta name="description" content="<?= Yii::$app->view->params['meta']['description'] ?>">


    <?php $this->head() ?>
</head>
<body >
<?php $this->beginBody() ?>

<div class="wrap">



    <section id="masterBody"
             class="master_body"
             style=" background-image: url(http://res.cloudinary.com/ddw31jew8/<?= Yii::$app->view->params['background_image'] ?>)">

        <div class="container">
            <a class="navbar-brand" href="/master">
                <img class="masterPtLogo" src="/img/pt_logo_glob_w.png" alt="Психотера - мастер">
            </a>

            <?= Alert::widget() ?>
            <?= $content ?>
        </div>

    </section>

</div>





<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
