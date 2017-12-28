<?php
use \yii\helpers\Html;
?>
<div class="col-md-10 mt20 col-md-offset-1 col-lg-10 col-lg-offset-1 articleBox">
    <div class="row">
        <div class="col-sm-12">
            <div class="imageBox text-center">
                <div class="less768">
                    <div class="backgroundImage"
                         style=" background-image: url(http://res.cloudinary.com/ddw31jew8/c_fill,h_480,w_690/<?= $article->topimagefile['cloudname'] ?>)"></div>
                </div>
                <div class="more768">
                    <?= cl_image_tag($article->topimagefile['cloudname'], [
                        'alt' => $article['topimage_alt']==null?$article['title']:$article['topimage_alt'],
                        "width" => 690,
                        "height" => 480,
                        'crop' => 'fill',
                    ]); ?>
                </div>


            </div>
        </div>
        <div class="col-sm-12 text-right">
            <?php if (isset($article->psys)) : ?>
                <?php foreach ($article->psys as $psy) : ?>
                    <h4 class="articlePsychotherapy"><?= Html::encode($psy['name']) ?></h4>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 text-left">
            <h1 class="articleName"><?= Html::encode($article['list_name']) ?></h1>
        </div>
        <div class="col-sm-12">
<!--            <p class="message">--><?//= Html::encode($article['message']) ?><!--...</p>-->

        </div>
        <div class="col-sm-12 ">
              <div class="text"><?= nl2br($article['text']) ?></div>

        </div>
        <div class="col-sm-6 col-sm-offset-6 text-right">
            <h4 class="articleAuthor"><?= Html::encode($article['author']) ?></h4>
        </div>
        <div class="col-sm-6 col-sm-offset-6 text-right">
            <?php if ($article->sites) : ?>
                <?php foreach ($article->sites as $site) : ?>
                    <p class="articleSite"><?= Html::a($site['name'],$site['link']) ?> </p>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="col-sm-12 text-left">
            <?php if ($article->tags) : ?>
                <p class="articleTag">
                    <?php $count = count($article->tags)?>
                    <?php foreach ($article->tags as $tag) : ?>
                        <span><?= Html::a($tag['name'], '/article/bytag/'.$tag['hrurl'] ) ?><?php if(--$count>0){echo', ';} ?></span>
                    <?php endforeach; ?>

                </p>
            <?php endif; ?>
        </div>

    </div>



</div>
