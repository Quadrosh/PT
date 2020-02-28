<?php

use common\models\Imagefiles;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */




?>
<div class="asbi-h_bs2-text--head_on_img <?= $model->color_key ?> <?= $model->custom_class ?>">


    <div class="row no-gutters flex-sm">

        <div class="col-sm-6 col-sm-push-6 flex-column">
            <div class="coverImgWrap ">
                <?php if ($model->header) : ?>
                    <p class="header mb0 <?= $model->header_class ?>"><?= $model->header ?></p>
                <?php endif; ?>

                <?php if ($model->image){
                    echo  Html::img('/img/view/'
                        . Imagefiles::TERM_CUT_OVERFLOW
                        . Imagefiles::SIZE_690_480
                        . $model->image,
                        [
                            'class' => 'cover',
                            'alt' => $model->image_alt,
                            'title'=>$model->image_title?$model->image_title:null,
                        ]);
                } ?>

            </div>


        </div>
        <div class="col-sm-6 col-sm-pull-6 flex-column flex-center relative">


            <?php if ($model->text) : ?>
                <p class="text <?= $model->text_class ?>" ><?= nl2br($model->text) ?></p>
            <?php endif; ?>

            <?php if ($model->link_name) : ?>
                <a href="<?= $model->link_url ?>" <?= $model->link_class?'class="'.$model->link_class.'"':null ?>><?= $model->link_name ?></a>
            <?php endif; ?>
            <?php if ($model->link_description) : ?>
                <p class="text-center"><?= nl2br($model->link_description) ?></p>
            <?php endif; ?>
        </div>
    </div>



</div>

