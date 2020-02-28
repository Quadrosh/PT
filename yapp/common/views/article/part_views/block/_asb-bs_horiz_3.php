<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */



?>
<div class="asb-bs_horiz_3 <?= $model->color_key ?> <?= $model->custom_class ?>">

    <?php if ($model->header) : ?>
        <h3 <?= $model->header_class?'class="'.$item->header_class.'"':null ?>><?= $model->header ?></h3>
    <?php endif; ?>

    <?php if ($model->description) : ?>
        <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= $model->description ?></p>
    <?php endif; ?>

    <?php if ($model->raw_text) : ?>
        <p <?= $model->raw_text_class?'class="'.$model->raw_text_class.'"':null ?>><?= nl2br($model->raw_text)  ?></p>
    <?php endif; ?>

    <?php if ($model->items) : ?>
        <div class="row">
            <?php $i=0; $count = count($model->items); foreach ( $model->items as $item)  : ?>
                <?php $i++; if ($i!=1 && $i%3==1) : ?>
        </div>
        <div class="row">
                <?php endif; ?>
                <div class="col-sm-4 <?php
                if ($i!=1 && $i%3==1 && $i+1 == $count){echo'col-sm-offset-2';}
                ?>">

                    <?php if ($item->view) : ?>
                        <?= $this->render('/article/part_views/block_item/'.$item->view, [
                            'model' => $item,
                        ]) ?>
                    <?php endif; ?>

                    <?php if (!$item->view) : ?>
                        <?= $this->render('/article/part_views/block_item/_asbi-default', [
                            'model' => $item,
                        ]) ?>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

    <?php if ($model->conclusion) : ?>
        <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
    <?php endif; ?>
</div>

