<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */



?>
<div class="asb-2col_specs <?= $model->color_key ?> <?= $model->custom_class ?>">

    <?php if ($model->header) : ?>
        <h3 class="<?= $model->header_class ?>"><?= $model->header ?></h3>
    <?php endif; ?>

    <?php if ($model->description) : ?>
        <p class="text-center"><?= $model->description ?></p>
    <?php endif; ?>

    <?php if ($model->items) : ?>
        <table class="table table-bordered">
            <tbody>
            <?php $i=0?>
            <?php foreach ($model->items as $item ) : ?>
                <?php if ($i==0) : ?>
                    <tr>
                <?php endif; ?>
                <?php if ($i%2 == 0 && count($model->items)!=$i+1) : ?>
                    </tr>
                    <tr>
                <?php endif; ?>
                <td class="text-left">
                    <?php if ($item->image) : ?>

                            <?= Html::img('/img/'.$item->image,['class'=>'w100 '.$item->image_class,
                            'alt'=>$item->image_alt,
                            'title'=>$item->image_title?$item->image_title:null])  ?>

                    <?php endif; ?>

                    <?php if ($item->header) : ?>
                            <span class="head <?= $item->header_class ?>"><?= $item->header ?>:</span>
                    <?php endif; ?>

                    <?php if ($item->description) : ?>
                            <span><?= $item->description ?></span>
                    <?php endif; ?>

                    <?php if ($item->link_name) : ?>
                            <a href="<?= $item->link_url ?>" class="<?= $item->link_class ?>"><?= $item->link_name ?></a>
                    <?php endif; ?>

                    <?php if ($item->text) : ?>
                            <span ><?= nl2br($item->text) ?></span>
                    <?php endif; ?>
                </td>
                <?php if (count($model->items)==$i+1) : ?>
                    </tr>
                <?php endif; ?>
            <?php $i++; ?>
            <?php endforeach; ?>
            </tbody>
        </table>


    <?php endif; ?>

    <?php if ($model->conclusion) : ?>
        <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
    <?php endif; ?>
</div>

