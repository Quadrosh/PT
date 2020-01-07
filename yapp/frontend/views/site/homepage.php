<?php

/* @var $this yii\web\View */
use \yii\helpers\Html;
use \yii\widgets\ListView;
use \common\models\Imagefiles;
?>
<div class="home">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
            <p class="topText">
                Мы стараемся донести максимум информации о душевном здоровье, его нарушениях и методах исцеления психических недугов.<br>
                Вы найдете здесь статьи на темы, связанные с психотерапией и каталог психотерапевтов.
                <span class="signature">Психотера</span>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 quoteBox">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <div class="imageBox">
                        <?=  Html::img('/img/view/' . Imagefiles::SIZE_WIDTH_600_HEIGHT_AUTO .$quote->imagefile['name'],
                            ['class' => 'img','style'=>'width:300px;']) ;?>

                    </div>
                </div>
                <div class="col-sm-6">
                    <p class="quoteText">
                        <?= $quote['text'] ?>
                    </p>
                    <p class="author">
                        <?= isset($quote['author'])?$quote['author']:'' ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
    <div class="row ">

        <div class="col-sm-12 popArt mt50">
            <h2 class="indexHead">Популярные статьи</h2>
            <div class="popularArticles">

                <?php foreach ($popularArticles as $popArticle) : ?>
                    <div class="popArtItem">
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="/article/<?= $popArticle['hrurl'] ?>" class="link2article">
                                    <?=  Html::img('/img/view/'
                                        . Imagefiles::TERM_CUT_OVERFLOW
                                        . Imagefiles::SIZE_560_360
                                        . $popArticle->topimagefile['name'],
                                        [
                                            'class' => 'img',
                                            'alt' => $popArticle['topimage_alt'],
                                            'style'=>'width:280px;'
                                        ]) ;?>

                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 text-right">
                                <?php if (isset($popArticle->psys)) : ?>
                                    <?php foreach ($popArticle->psys as $psy) : ?>
                                        <h4 class="articlePsychotherapy"><?= Html::a($psy['name'], '/article/bypsy/'.$psy['hrurl'] ) ?></h4>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-xs-12">
                                <a href="/article/<?= $popArticle['hrurl'] ?>" class="link2article">
                                    <h4 class="articleName text-center"><?= Html::encode($popArticle['list_name']) ?></h4>
                                    <p class="excerpt"><?= Html::encode($popArticle['excerpt']) ?>...</p>
                                </a>
                            </div>
                            <div class="col-sm-12 text-right">
                                <h4 class="articleAuthor"><?= Html::encode($popArticle['author']) ?></h4>
                            </div>
                            <div class="col-sm-12  text-right">
                                <?php if ($popArticle->sites) : ?>
                                    <?php foreach ($popArticle->sites as $site) : ?>
                                        <p class="articleSite"><?= Html::a($site['name'],$site['link']) ?> </p>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-12  text-left">
                                <?php if ($popArticle->tags) : ?>
                                    <p class="articleTag">
                                        <?php $count = count($popArticle->tags)?>
                                        <?php foreach ($popArticle->tags as $tag) : ?>
                                            <span><?= Html::a($tag['name'], '/article/bytag/'.$tag['hrurl'] ) ?><?php if(--$count>0){echo', ';} ?></span>
                                        <?php endforeach; ?>

                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>



                <?php endforeach; ?>

            </div>
            <a class="carouselControl popArtPrev"><svg version="1.1"
                                                       xmlns="http://www.w3.org/2000/svg"
                                                       xmlns:xlink="http://www.w3.org/1999/xlink"
                                                       x="0px" y="0px"
                                                       viewBox="0 0 100 100"
                                                       style="enable-background:new 0 0 100 100;"
                                                       xml:space="preserve">
    <style type="text/css">
        .button_x5F_left_st0{fill:none;stroke-width:3;stroke-miterlimit:10;}
        .button_x5F_left_st1{fill:none;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;}
    </style>
                    <g >
                        <circle  class="button_x5F_left_st0" cx="49.7" cy="50" r="46.4"/>
                        <line  class="button_x5F_left_st1" x1="38.9" y1="50" x2="61.5" y2="27.5"/>
                        <line  class="button_x5F_left_st1" x1="38.9" y1="50.5" x2="61.5" y2="73"/>
                    </g>
    </svg></a>

            <a class="carouselControl popArtNext" ><svg version="1.1"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                                        x="0px" y="0px"
                                                        viewBox="0 0 100 100"
                                                        style="enable-background:new 0 0 100 100;"
                                                        xml:space="preserve">
    <style type="text/css">
        .button_x5F_right_st0{fill:none;stroke-width:3;stroke-miterlimit:10;}
        .button_x5F_right_st1{fill:none;stroke-width:3;stroke-linecap:round;stroke-miterlimit:10;}
    </style>
                    <g >
                        <circle  class="button_x5F_right_st0" cx="49.7" cy="50" r="46.4"/>
                        <line  class="button_x5F_right_st1" x1="61.5" y1="50.5" x2="38.9" y2="73"/>
                        <line  class="button_x5F_right_st1" x1="61.5" y1="50" x2="38.9" y2="27.5"/>
                    </g>
    </svg></a>
        </div>

    </div>

    <div class="row ">
        <div class="col-sm-12 mt50">
            <h2 class="indexHead">Психотерапевты</h2>
        </div>
        <div class="col-sm-12 popVertWrap">
            <div class="popularMasters">

                <?php echo ListView::widget([
                    'dataProvider' => $popMasterDataProvider,
                    'itemView' => '_master_list_item',
                ]);?>

            </div>

        </div>
        <div class="col-sm-12 text-center">
            <p class="footer" >
                <?= Yii::$app->name ?> <?= date('Y') ?> <br>
                По всем вопросам, связанным с работой сайта <br>
                обращайтесь на webmaster@psihotera.ru <br>
                или по тел. +7 (985) 346-16-15
            </p>

        </div>

    </div>
</div>
