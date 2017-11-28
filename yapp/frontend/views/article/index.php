<?php

/* @var $this yii\web\View */
use \yii\helpers\Html;
?>



<div class="row topItem">
    <a href="/article/<?= $topArticle['hrurl'] ?>" class="link2article">
    <div class="col-sm-6 imageBox more768" style=" background-image: url(http://res.cloudinary.com/ddw31jew8/c_fill,h_480,w_690/<?= $topArticle->topimagefile['cloudname'] ?>)">
    </div>
    </a>
    <div class="col-sm-6 col-xs-12">
        <div class="col-xs-12 text-center">
            <?php if (isset($topArticle->psys)) : ?>
                <?php foreach ($topArticle->psys as $psy) : ?>
                    <h4 class="articlePsychotherapy"><?= Html::a($psy['name'], '/article/bypsy/'.$psy['hrurl'] ) ?></h4>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <a href="/article/<?= $topArticle['hrurl'] ?>" class="link2article">
            <h4 class="articleName text-center"><?= Html::encode($topArticle['list_name']) ?></h4>
            <p class="excerpt"><?= Html::encode($topArticle['excerpt_big']) ?>...</p>
        </a>
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
                                        <?= cl_image_tag($popArticle->topimagefile['cloudname'], [
                                            "alt" => $popArticle['topimage_alt'],
    //                                "width" => 180,
    //                                "height" => 135,
                                            "width" => 280,
                                            "height" => 180,
    //                                        "height" => 210,
                                            "crop" => "fill"
                                        ]); ?>
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
<!--                                <div class="col-sm-12  text-left">-->
<!--                                    --><?php //if ($popArticle->tags) : ?>
<!--                                        <p class="articleTag">-->
<!--                                            --><?php //$count = count($popArticle->tags)?>
<!--                                            --><?php //foreach ($popArticle->tags as $tag) : ?>
<!--                                                <span>--><?//= Html::a($tag['name'], '/article/bytag/'.$tag['hrurl'] ) ?><!----><?php //if(--$count>0){echo', ';} ?><!--</span>-->
<!--                                            --><?php //endforeach; ?>
<!---->
<!--                                        </p>-->
<!--                                    --><?php //endif; ?>
<!--                                </div>-->
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

