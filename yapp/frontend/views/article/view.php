<?php
use \yii\helpers\Html;
?>
<div class="col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1 articleBox">
    <div class="row">
        <div class="col-sm-12">
            <div class="imageBox text-center">
                <?= cl_image_tag($article->topimagefile['cloudname'], [
                    "alt" => $article['topimage_alt'],
                    "width" => "auto",
                    "crop" => "fill"
                ]); ?>
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
              <div class="text"><?= nl2br($article['text']) ?>...</div>

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

    </div>



</div>
