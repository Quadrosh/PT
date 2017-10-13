<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
?>

    <div class="articleListItem">
        <div class="row">
                <div class="col-sm-3 col-md-2">
                    <div class="imageBox">
                        <a href="/article/<?= $model['hrurl'] ?>" class="link2article">
                            <?= cl_image_tag($model->topimagefile['cloudname'], [
                                "alt" => $model['topimage_alt'],
                                "width" => 180,
                                "height" => 135,
                                "crop" => "fill"
                            ]); ?>
                        </a>
                    </div>
                </div>
                <div class="col-sm-9 col-md-10 listDataBox">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php if (isset($model->psys)) : ?>
                                <?php foreach ($model->psys as $psy) : ?>
                                    <h4 class="articlePsychotherapy"><?= Html::a($psy['name'], '/article/bypsy/'.$psy['hrurl'] ) ?></h4>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-12">
                            <a href="/article/<?= $model['hrurl'] ?>" class="link2article">
                                <h4 class="articleName"><?= Html::encode($model['list_name']) ?></h4>
                                <p class="excerptBig"><?= Html::encode($model['excerpt_big']) ?>...</p>
                            </a>
                        </div>
                        <div class="col-sm-12 text-right">
                            <h4 class="articleAuthor"><?= Html::encode($model['author']) ?></h4>
                        </div>
                        <div class="col-sm-6 col-sm-push-6 text-right">
                            <?php if ($model->sites) : ?>
                                <?php foreach ($model->sites as $site) : ?>
                                    <p class="articleSite"><?= Html::a($site['name'],$site['link']) ?> </p>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="col-sm-6 col-sm-pull-6 text-left">
                            <?php if ($model->tags) : ?>
                                <p class="articleTag">
                                    <?php $count = count($model->tags)?>
                                    <?php foreach ($model->tags as $tag) : ?>
                                        <span><?= Html::a($tag['name'], '/article/bytag/'.$tag['hrurl'] ) ?><?php if(--$count>0){echo', ';} ?></span>
                                    <?php endforeach; ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
        </div>
    </div>

