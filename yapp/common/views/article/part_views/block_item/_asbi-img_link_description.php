<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */




?>
<div class="asb-img_link_description text-center">

    <?php if ($model->header) : ?>
        <p class="<?= $model->header_class ?>"><?= $model->header ?></p>
    <?php endif; ?>
    <?php if ($model->description) : ?>
        <p class="text-center"><?= $model->description ?></p>
    <?php endif; ?>
    <?php if ($model->image) : ?>
        <?= Html::img('/img/'.$model->image,[
                'class'=>'w100',
                'alt'=>$model->image_alt,
                'title'=>$model->image_title?$model->image_title:null])  ?>
    <?php endif; ?>
    <?php if ($model->link_name) : ?>
        <a href="<?= $model->link_url ?>" class="<?= $model->link_class ?>"><?= $model->link_name ?></a>
    <?php endif; ?>
    <?php if ($model->link_description) : ?>
        <p class="text-center"><?= $model->link_description ?></p>
    <?php endif; ?>

</div>

