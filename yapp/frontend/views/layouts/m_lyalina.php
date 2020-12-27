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

\frontend\assets\MlyalinaAsset::register($this);
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
    <meta property="og:site_name" content="Мария Лялина - телесно ориентированная психотерапия" />
    <meta property="og:title" content="<?= Yii::$app->view->params['title'] ?>" />
    <meta property="og:description" content="<?= Yii::$app->view->params['description'] ?>" />
    <meta property="og:url" content="<?= yii\helpers\Url::current(['lg'=>null], true) ?>" />
    <meta property="og:image" content="<?= yii\helpers\Url::base(true) ?>/img/articlesection28image.jpg" />

    <?php $this->head() ?>

    <?php if (Url::base('')=='//psihotera.ru') : ?>
        <?php include_once("analytics_google.php") ?>
        <?php include_once("analytics_yandex.php") ?>   <!--    общий -->
        <!-- Yandex.Metrika counter -->      <!--    личный  -->
        <script type="text/javascript" >
            (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
                m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym(70844776, "init", {
                clickmap:true,
                trackLinks:true,
                accurateTrackBounce:true
            });
        </script>
        <noscript><div><img src="https://mc.yandex.ru/watch/70844776" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
    <?php endif; ?>




</head>
<body <?php
if ( Yii::$app->request->url == '/lyalina/services') {
echo 'class="brightBody"';
}
?>>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Психотерапия',
        'brandUrl' => '/lyalina',
        'options' => [
            'class' => 'navbar-inverse navbar-top navbar navbar-fixed-top',
        ],
        'innerContainerOptions' => ['class' => 'container-fluid'],
    ]);


    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'encodeLabels' => false,
        'items' => [
        [
            'label' => 'Главная',
            'url' => ['/lyalina'],
            'active' =>  Yii::$app->request->url == '/lyalina',
        ],
        [
            'label' => 'Обо мне',
            'url' => ['/lyalina/about'],
            'active' => Yii::$app->request->url == '/lyalina/about',
        ],
        [
            'label' => 'Услуги',
            'url' => ['/lyalina/services'],
            'active' => Yii::$app->request->url == '/lyalina/services',

        ],
        [
            'label' => 'Вопрос - ответ',
            'url' => ['/lyalina/faq'],
            'active' => Yii::$app->request->url == '/lyalina/faq',

        ],
//        [
//            'label' => 'Блог',
//            'url' => ['/she/blog'],
//            'active' => Yii::$app->request->url == '/she/blog',
//        ],
        [
            'label' => 'Записаться',
            'url' => ['/lyalina/contact'],
            'active' => Yii::$app->request->url == '/lyalina/contact',
            'linkOptions' => [
                'class' => 'contact_link',
            ],
        ],
    ],
    ]);

    $ptLogoGlob = '<svg version="1.1" 
	xmlns="http://www.w3.org/2000/svg" 
	xmlns:xlink="http://www.w3.org/1999/xlink" 
	x="0px" y="0px"
	viewBox="0 0 170 170" 
	style="enable-background:new 0 0 170 170;" 
	xml:space="preserve">

<g >
	<path class="fillFromKey" d="M151.2,67.3c0-28.2-17.5-52.2-42.2-62c-1.6-0.6-3.3,0.1-4,1.6l0,0c-0.9,1.8,0,4,1.8,4.7
		c22.2,8.9,37.8,30.6,37.7,55.9c-0.1,32.3-27.3,59.5-59.6,59.7c-11,0.1-21.3-2.9-30.2-8c-1.7-1-3.8-0.3-4.7,1.4l0,0
		c-0.8,1.6-0.2,3.5,1.3,4.3c9.2,5.3,19.8,8.5,31.2,8.8c-1.7,14.5-13.3,26-27.8,27.5c-0.9,0.1-1.6,0.8-1.6,1.7c0,0.2,0,0.4,0,0.5v0
		c0,1,0.8,1.8,1.8,1.8h59.5c1,0,1.8-0.8,1.8-1.8l0,0c0-0.2,0-0.4,0-0.6c0-0.9-0.7-1.6-1.6-1.7c-14.4-1.7-25.9-13.1-27.6-27.5
		C122.6,132.7,151.2,103.3,151.2,67.3z"/>
	<path  class="fillFromKey" d="M97.7,45.2c1-4.1,2.5-8,5.1-11.4c0.7-1,1.3-2,1.5-3.2c0.2-1.6,1-2.9,2.1-4.1
		c0.9-0.9,1.9-1.8,3.1-2.4c1.9-1,3.7-2,5.5-2.9c0.5-0.2,0.9-0.4,1.4-0.6c-8.2-5.6-17.9-9.1-28.5-9.7c-0.2,0-0.4,0-0.6,0
		c-0.3,0-0.6,0-0.9,0c-0.5,0-1,0-1.5,0c-0.1,0-0.2,0-0.3,0c-0.1,0-0.2,0-0.3,0c-0.5,0-1,0-1.5,0c-0.3,0-0.6,0-0.9,0
		c-0.2,0-0.4,0-0.6,0C70.7,11.5,61,15,52.8,20.6c0.5,0.2,0.9,0.4,1.4,0.6c1.9,0.9,3.7,2,5.5,2.9c1.2,0.6,2.2,1.4,3.1,2.4
		c1.1,1.1,1.9,2.5,2.1,4.1c0.2,1.2,0.7,2.2,1.5,3.2c2.6,3.4,4.1,7.3,5.1,11.4c0.4,1.6,0.5,3.3,0.8,5c0.2,0.9,0,1.8-0.3,2.7
		c-0.7,1.8-0.6,3.7,0.1,5.4c0.6,1.3,1.3,2.5,2,3.8c1,1.6,2.1,3.1,3.1,4.7c0.7,1,1.4,1.9,2.1,2.9c1.2,1.8,0.2,4.3-1.6,5
		c-0.5,0.2-1,0.5-1.5,0.8c-0.7,0.4-1.1,1.1-0.9,1.9c0.2,1,0.4,2.1,0.7,3.1c0.1,0.6,0.4,1.2,0.5,1.8c0.2,1.2-0.2,1.8-1.2,2.4
		c-0.4,0.2-0.7,0.4-1,0.6c0.6,0.7,1.2,1.2,1.6,1.8c0.6,1,0.3,2-0.6,2.8c-0.5,0.4-1,1-1.4,1.5c-0.5,0.7-0.6,1.5-0.3,2.4
		c0.4,1.2,0.6,2.5,0.6,3.8c-0.1,2.7-1.7,5.3-4.4,6.2c-1.3,0.4-2.6,0.7-4,0.7c-2.8,0.1-5.6,0.2-8.4,0.6c-2.3,0.3-4.6,0.7-6.7,1.8
		c-1.3,0.7-2.5,1.5-3.3,2.7c0,0,0,0,0,0c10,8.8,23,14.2,37.4,14.2c14.3,0,27.4-5.4,37.4-14.2c0,0,0,0,0,0c-0.9-1.2-2-2.1-3.3-2.7
		c-2.1-1.1-4.4-1.5-6.7-1.8c-2.8-0.4-5.6-0.5-8.4-0.6c-1.4-0.1-2.7-0.3-4-0.7c-2.7-0.9-4.3-3.5-4.4-6.2c0-1.3,0.1-2.6,0.6-3.8
		c0.3-0.9,0.2-1.7-0.3-2.4c-0.4-0.6-0.9-1.1-1.4-1.5C93,89,92.7,88,93.4,87c0.4-0.7,1-1.2,1.6-1.8c-0.3-0.2-0.6-0.4-1-0.6
		c-1-0.5-1.4-1.2-1.2-2.4c0.1-0.6,0.3-1.2,0.5-1.8c0.2-1,0.5-2.1,0.7-3.1c0.2-0.8-0.2-1.5-0.9-1.9c-0.5-0.3-1-0.6-1.5-0.8
		c-1.7-0.7-2.8-3.2-1.6-5c0.7-1,1.4-1.9,2.1-2.9c1.1-1.5,2.1-3.1,3.1-4.7c0.8-1.2,1.5-2.5,2-3.8c0.7-1.8,0.8-3.6,0.1-5.4
		c-0.3-0.9-0.5-1.7-0.3-2.7C97.2,48.5,97.4,46.8,97.7,45.2z"/>
</g>
</svg>';

    $svgVK = '<svg xmlns="http://www.w3.org/2000/svg" 
	viewBox="0 0 3333 1980" 
	shape-rendering="geometricPrecision" 
	text-rendering="geometricPrecision" 
	image-rendering="optimizeQuality" 
	style="width: 30px;"
	fill-rule="evenodd" 
	clip-rule="evenodd"><path class="fillFromKey" d="M3257 134c23-77 0-134-110-134h-365c-93 0-135 49-159 103 0 0-185 452-448 746-85 85-124 112-170 112-23 0-58-27-58-104V135c0-93-26-134-103-134h-573c-58 0-93 43-93 84 0 88 131 108 145 355v537c0 118-21 139-68 139-124 0-424-454-603-974C617 41 582 0 489 0H124C20 0-1 49-1 103c0 97 124 576 576 1209 301 433 726 667 1112 667 232 0 260-52 260-142v-327c0-104 22-125 95-125 54 0 147 27 363 236 247 247 288 358 427 358h365c104 0 156-52 126-155-33-102-151-251-308-427-85-100-212-209-251-263-54-70-39-100 0-162 0 0 444-626 491-838z"/></svg>';

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => [
            [
                'label' => $svgVK,
                'url' => 'https://vk.com/lyalinagoddess',
                'linkOptions' => ['target' => '_blank','rel'=>'nofollow'],
            ],
        ],
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
    <div class="container-fluid">

        <div class="row">
            <div class="col-xs-4 text-left">
                <?= Html::a($ptLogoGlob,'/',
                    [
                        'class' => 'footerPtLogo',
                        'alt' => 'Psihotera.ru ',
                        'title'=>'Psihotera.ru',
                    ]) ?>
                <br>
                <?=
                Html::a('Оговорка','/disclaimer',['class'=>'disclaimerLink', 'target' => '_blank','rel'=>'nofollow'])
                ?>
            </div>
            <div class="col-xs-4 text-center">
                <?=
                Html::a($svgVK,'https://vk.com/lyalinagoddess',[
                        'class' => 'footerVKsvg',
                        'target' => '_blank',
                        'rel'=>'nofollow',
                ])
                ?>
            </div>

        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
