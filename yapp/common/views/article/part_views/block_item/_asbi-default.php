<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */




?>
<div class="asbi-default text-center  <?= $model->color_key ?> <?= $model->custom_class ?>">

    <?php if ($model->image) {
        echo Html::img('/img/'.$model->image,[ 'alt'=>$model->image_alt, 'class'=>$model->image_class,'title'=>$model->image_title?$model->image_title:null]);
    } ?>
    <?php if ($model->header) : ?>
        <h4 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= nl2br($model->header) ?></h4>
    <?php endif; ?>
    <?php if ($model->description) : ?>
        <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= nl2br($model->description) ?></p>
    <?php endif; ?>

    <?php if ($model->text) : ?>
        <p <?= $model->text_class?'class="'.$model->text_class.'"':null ?>><?= nl2br($model->text)  ?></p>
    <?php endif; ?>

    <?php if ($model->link_name) : ?>
        <a href="<?= $model->link_url ?>" <?= $model->link_class?'class="'.$model->link_class.'"':null ?>><?= $model->link_name ?></a>
    <?php endif; ?>
    <?php if ($model->link_description) : ?>
        <p class="text-center"><?= nl2br($model->link_description) ?></p>
    <?php endif; ?>





</div>






