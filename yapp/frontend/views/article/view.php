<?php

use common\models\Imagefiles;
use \yii\helpers\Html;
?>
<div class="col-md-10 mt20 col-md-offset-1 col-lg-10 col-lg-offset-1 articleBox">
    <div class="row">
        <div class="col-sm-12">
            <div class="imageBox text-center">
                <?php if ($article->topimagefile) : ?>
                    <div class="less768">
                        <div class="backgroundImage"
                             style=" background-image: url(<?= '/img/view/'
                             . Imagefiles::TERM_CUT_OVERFLOW
                             . Imagefiles::SIZE_690_480
                             . $article->topimagefile['name'] ?>)"></div>
                    </div>
                    <div class="more768">
                        <?=  Html::img('/img/view/'
                            . Imagefiles::TERM_CUT_OVERFLOW
                            . Imagefiles::SIZE_690_480
                            . $article->topimagefile['name'],
                            [
                                'class' => 'img',
                                'alt' => $article['topimage_alt']==null?$article['title']:$article['topimage_alt'],
                            ]) ;?>
                    </div>

                <?php endif; ?>

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
            <h1 class="articleName"><?= Html::encode($article->pagehead) ?></h1>
        </div>
        <div class="col-sm-12">
<!--            <p class="message">--><?//= Html::encode($article['message']) ?><!--...</p>-->

        </div>
        <div class="col-sm-12 ">
              <div class="text"><?= nl2br($article['text']) ?></div>
        </div>

        <?php if ($article->author) : ?>
            <div class="col-sm-6 col-sm-offset-6 text-right">
                <h4 class="articleAuthor"><?= Html::encode($article['author']) ?></h4>
            </div>
        <?php endif; ?>

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

        <div class="col-sm-12 text-center pt50">
        <?php




            if ($article->call2action_name){
                if ($article->call2action_link == 'goBack') {
                    if (Yii::$app->request->referrer) {
                        echo Html::a( $article->call2action_name, Yii::$app->request->referrer,['class'=>$article->call2action_class]);
                    } else {
                        echo Html::a( $article->call2action_name,'/',['class'=>$article->call2action_class]);
                    }

                } else {
                    echo Html::a($article->call2action_name,$article->call2action_link,['class'=>$article->call2action_class]);
                }

            }
        ?>
        </div>


    </div>



</div>
