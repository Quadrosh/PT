<?php

/* @var $this yii\web\View */

use common\models\Imagefiles;
use \yii\helpers\Html;
?>



<div class="row topItem">
    <a href="/article/<?= $topArticle['hrurl'] ?>" class="link2article">
    <div class="col-sm-6 imageBox more768" style=" background-image: url(<?= '/img/view/'
    . Imagefiles::TERM_CUT_OVERFLOW
    . Imagefiles::SIZE_690_480
    . $topArticle->topimagefile['name'] ?>)"
           >
    </div>
    </a>
    <div class="col-sm-6 col-xs-12">
        <?php if ($topArticle->psys) : ?>
        <div class="col-xs-12 text-center">

            <?php foreach ($topArticle->psys as $psy) : ?>
                <h4 class="articlePsychotherapy"><?= Html::a($psy['name'], '/article/bypsy/'.$psy['hrurl'] ) ?></h4>
            <?php endforeach; ?>

        </div>
        <a href="/article/<?= $topArticle['hrurl'] ?>" class="link2article">
            <h4 class="articleName text-center"><?= Html::encode($topArticle['list_name']) ?></h4>
            <p class="excerpt"><?= Html::encode($topArticle['excerpt_big']) ?>...</p>
        </a>
        <?php endif; ?>
        <?php if ($topArticle->psys == null) : ?>

            <a href="/article/<?= $topArticle['hrurl'] ?>" class="link2article">
                <h4 class="articleNameOnEmptyPsy text-center"><?= Html::encode($topArticle['list_name']) ?></h4>
                <p class="excerpt"><?= Html::encode($topArticle['excerpt_big']) ?>...</p>
            </a>

        <?php endif; ?>


        <div class="col-sm-12 text-right">
            <h4 class="articleAuthor"><?= Html::encode($topArticle['author']) ?></h4>
        </div>
        <div class="col-sm-6 col-sm-push-6 text-right">
            <?php if ($topArticle->sites) : ?>
                <?php foreach ($topArticle->sites as $site) : ?>
                    <p class="articleSite"><?= Html::a($site['name'],$site['link']) ?> </p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="col-sm-6 col-sm-pull-6 text-left">
            <?php if ($topArticle->tags) : ?>
                <p class="articleTag">
                    <?php $count = count($topArticle->tags)?>
                    <?php foreach ($topArticle->tags as $tag) : ?>
                        <span><?= Html::a($tag['name'], '/article/bytag/'.$tag['hrurl'] ) ?><?php if(--$count>0){echo', ';} ?></span>
                    <?php endforeach; ?>

                </p>
            <?php endif; ?>
        </div>

    </div>
</div>

<div class="container">
    <div class="site-index">

        <div class="row ">

            <div class="col-sm-12 popArt">
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
                                                'alt' => $popArticle['topimage_alt']?$popArticle['topimage_alt']:'изображение '.$popArticle['title'],
                                                'style'=>'width:280px;'
                                            ]) ;?>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <?php if ($popArticle->psys) : ?>
                                        <?php foreach ($popArticle->psys as $psy) : ?>
                                            <h4 class="articlePsychotherapy"><?= Html::a($psy['name'], '/article/bypsy/'.$psy['hrurl'] ) ?></h4>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if ($popArticle->psys == null) : ?>
                                        <div class="articlePsychotherapyEmpty"> </div>
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
            <div class="col-sm-12">
                <h2 class="indexHead">Последние добавленные</h2>
                <?php echo \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_article_list_item',
                ]);?>
            </div>
        </div>




    </div>
</div>

