<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use \yii\widgets\ActiveForm;

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
</head>
<body class="articleIndex">
<?php $this->beginBody() ?>

<div class="wrap">

    <!-- поиск < 768 -->
    <?php $form = ActiveForm::begin([
        'id'=>'searchFormNarrow',
        'action' => ['/article/search'],
        'method' => 'post',
    ]); $seachForm = new \common\models\SearchForm(); ?>
    <div class="searchForm">
        <?= $form->field($seachForm, 'search')
            ->textInput([
                'class' => 'btn btn-default search-input ',
                'value' => isset(Yii::$app->view->params['search'])?Yii::$app->view->params['search']:'' ,
                'required'=>true,
                'id'=>'searchFormNarrow-search',
            ])
            ->label(false) ?>

        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'btn btn-default search-submit ']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- /поиск < 768 -->

    <?php NavBar::begin([
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
    ]; ?>

    <!-- поиск -->
    <?php $form = ActiveForm::begin([
        'id'=>'searchForm',
        'action' => ['/article/search'],
        'method' => 'post',
    ]); $seachForm = new \common\models\SearchForm(); ?>
    <div class="searchForm">
        <?= $form->field($seachForm, 'search')
            ->textInput([
                'class' => 'btn btn-default search-input ',
                'value' => isset(Yii::$app->view->params['search'])?Yii::$app->view->params['search']:'' ,
                'required'=>true,
                'id'=>'searchForm-search',
            ])
            ->label(false) ?>

        <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i>', ['class' => 'btn btn-default search-submit ']) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <!-- /поиск -->


    <?php echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]); ?>


    <?php NavBar::end(); ?>



    <div class="container noPadding">
<!--        --><?//= Breadcrumbs::widget([
//            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
//        ]) ?>


        <?= Alert::widget() ?>

    </div>
    <?= $content ?>
</div>

<!--<footer class="footer">-->
<!--    <div class="container">-->
<!--        <p class="pull-left">&copy; --><?//= Yii::$app->name ?><!-- --><?//= date('Y') ?><!--</p>-->
<!---->
<!--        <p class="pull-right">--><?//= Yii::powered() ?><!--</p>-->
<!--    </div>-->
<!--</footer>-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
