<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */



?>
<div class="asb-slick_leadbox ">

    <div class="carouselWrapper p10 uppercase slickMulti"
         data-id="<?= $model->id ?>" data-showItems="1">
        <?php if ($model->header) : ?>
            <h3 class="<?= $model->header_class ?>"><?= $model->header ?></h3>
        <?php endif; ?>

        <?php if ($model->description) : ?>
            <p class="text-center"><?= $model->description ?></p>
        <?php endif; ?>

        <?php if ($model->items) : ?>
            <div
                 class="asb-slick_1_item slick_multi_<?= $model->id ?>  text-center">
                <?php foreach ($model->items as $item) : ?>
                    <div class="carousel_item">

                        <?php if ($item->view) : ?>
                            <?= $this->render('/article/part_views/block_item/'.$item->view, [
                                'model' => $item,
                            ]) ?>
                        <?php endif; ?>

                        <?php if (!$item->view) : ?>
                            <?php if ($item->header) : ?>
                                <h4 class="<?= $item->header_class ?>"><?= $item->header ?></h4>
                            <?php endif; ?>
                            <?php if ($item->description) : ?>
                                <p class="text-center"><?= $item->description ?></p>
                            <?php endif; ?>
                            <?php if ($item->image) : ?>
                                <?= Html::img('/img/'.$item->image,['class'=>'max-w100per'])  ?>
                            <?php endif; ?>
                            <?php if ($item->link_name) : ?>
                                <a href="<?= $item->link_url ?>" class="<?= $item->link_class ?>"><?= $item->link_name ?></a>
                            <?php endif; ?>
                            <?php if ($item->link_description) : ?>
                                <p class="text-center"><?= $item->link_description ?></p>
                            <?php endif; ?>

                            <?php if ($item->text) : ?>
                                <p ><?= nl2br($item->text) ?></p>
                            <?php endif; ?>

                        <?php endif; ?>


                    </div>
                <?php endforeach; ?>
            </div>



            <a class="carouselControl btn slickNext slickNext<?= $model->id ?>" ><i class="glyphicon glyphicon-arrow-right"></i></a>

        <?php endif; ?>
    </div>


</div>

