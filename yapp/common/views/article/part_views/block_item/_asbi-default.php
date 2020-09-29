<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */


$structure = $model->structure;
$imgVertical = false;
$imgHorizontal = false;
$imgSquare = false;
$imgSize = false;

if ($structure) {
    foreach (explode('&', $structure) as $chunk) {
        $param = explode("=", $chunk);
        if ($param[0]=='imgVertical' || $param[0]=='img_vertical') {
            $imgVertical=$param[1];
        }
        if ($param[0]=='imgHorizontal' || $param[0]=='img_horizontal') {
            $calc_code=$param[1];
        }
        if ($param[0]=='imgSquare' || $param[0]=='img_square') {
            $imgSquare=$param[1];
        }
        if ($param[0]=='imgSize' || $param[0]=='img_size') {
            $imgSize=$param[1];
        }
    }
}


?>
<div class="asbi-default  <?= $model->color_key ?> <?= $model->custom_class ?>">

    <?php if ($model->image) {

        $options = [
            'alt'=>$model->image_alt,
            'class'=>$model->image_class,
            'tile'=>$model->image_title
        ];

        if ($imgSize) {
            echo Html::img('/img/view/cutoverflow_'.$imgSize.'_'.$model->image, $options);
        } else if ($imgVertical) {
            echo Html::img('/img/view/cutoverflow_480x690_'.$model->image, $options);
        } else if ($imgHorizontal) {
            echo Html::img('/img/view/cutoverflow_690x480_'.$model->image, $options);
        } else if ($imgSquare) {
            echo Html::img('/img/view/cutoverflow_690x690_'.$model->image, $options);
        } else { // оргигинал
            echo Html::img('/img/'.$model->image,$options);
        }

    } ?>

    <?php if ($model->header) : ?>
        <h4 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= nl2br($model->header) ?></h4>
    <?php endif; ?>
    <?php if ($model->description) : ?>
        <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= nl2br($model->description) ?></p>
    <?php endif; ?>

    <?php if ($model->text) : ?>
        <p class="text <?= $model->text_class ?>" ><?= nl2br($model->text)  ?></p>
    <?php endif; ?>

    <?php if ($model->comment) : ?>
        <p class="comment <?= $model->comment_class ?>" ><?= nl2br($model->comment)  ?></p>
    <?php endif; ?>

    <?php if ($model->link_name) : ?>
        <a href="<?= $model->link_url ?>" <?= $model->link_class?'class="'.$model->link_class.'"':null ?>><?= $model->link_name ?></a>
    <?php endif; ?>
    <?php if ($model->link_description) : ?>
        <p class="text-center"><?= nl2br($model->link_description) ?></p>
    <?php endif; ?>





</div>






