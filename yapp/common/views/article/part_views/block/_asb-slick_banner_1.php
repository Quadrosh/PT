<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */



?>
<div class="asb-slick_banner_1">

    <div class="carouselWrapper">
        <?php if ($model->header) : ?>
            <h4 class="<?= $model->header_class ?>"><?= $model->header ?></h4>
        <?php endif; ?>

        <?php if ($model->description) : ?>
            <p class="text-center"><?= $model->description ?></p>
        <?php endif; ?>

        <?php if ($model->items) : ?>
            <div class="asb-slick_banner_1_carousel text-center">
                <?php foreach ($model->items as $item) : ?>
                    <div class="carousel_item">

                        <?php if ($item->view) : ?>
                            <?= $this->render($item->view, [
                                'model' => $item,
                            ]) ?>
                        <?php endif; ?>

                        <?php if (!$item->view) : ?>
                            <?php if ($item->header) : ?>
                                <h6 class="<?= $item->header_class ?>"><?= $item->header ?></h6>
                            <?php endif; ?>
                            <?php if ($item->description) : ?>
                                <p class="text-center"><?= $item->description ?></p>
                            <?php endif; ?>
                            <?php if ($item->image) : ?>
                                <?= Html::img('/img/'.$item->image,['class'=>'w100 '.$item->image_class,
                                    'alt'=>$item->image_alt,
                                    'title'=>$item->image_title?$item->image_title:null,])  ?>
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
            <a class="carouselControl asb-slick_banner_1_slickPrev"><svg version="1.1"
                                                                         xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                                         viewBox="0 0 30 80"
                                                                         style="enable-background:new 0 0 30 80;"
                                                                         xml:space="preserve">
<defs>
    <filter id="caru_arr_l_shadow" x="-2" y="-2" width="30" height="80">
        <feDropShadow dx="1" dy="1" stdDeviation="2" flood-color="#838e9a" flood-opacity="0.5"/>
        <feDropShadow dx="-1" dy="-1" stdDeviation="2" flood-color="#838e9a" flood-opacity="0.5" />
    </filter>
</defs>
                    <style type="text/css">
                        .caru_arr_l_st0{filter:url(#caru_arr_l_shadow);}
                    </style>
                    <path class="caru_arr_l_st0" d="M10.7,40l10.9-30c0.2-0.5-0.1-1.1-0.6-1.3c-0.5-0.2-1.1,0.1-1.3,0.6l-11,30.3c0,0,0,0.1,0,0.1c0,0.1,0,0.1,0,0.2
	s0,0.1,0,0.2c0,0,0,0.1,0,0.1l11,30.3c0.1,0.4,0.5,0.7,0.9,0.7c0.1,0,0.2,0,0.3-0.1c0.5-0.2,0.8-0.8,0.6-1.3L10.7,40z"/>
</svg></a>

            <a class="carouselControl asb-slick_banner_1_slickNext" ><svg version="1.1"
                                                                          xmlns="http://www.w3.org/2000/svg"
                                                                          xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                          x="0px" y="0px"
                                                                          viewBox="0 0 30 80"
                                                                          style="enable-background:new 0 0 30 80;"
                                                                          xml:space="preserve">
<defs>
    <filter id="caru_arr_r_shadow" x="-2" y="-2" width="30" height="80">
        <feDropShadow dx="1" dy="1" stdDeviation="2" flood-color="#838e9a" flood-opacity="0.5"/>
        <feDropShadow dx="-1" dy="-1" stdDeviation="2" flood-color="#838e9a" flood-opacity="0.5"/>
    </filter>
</defs>
                    <style type="text/css">
                        .caru_arr_r_st0{filter:url(#caru_arr_r_shadow);}
                    </style>
                    <path class="caru_arr_r_st0" d="M19.5,40L8.7,10C8.5,9.5,8.7,8.9,9.3,8.8c0.5-0.2,1.1,0.1,1.3,0.6l11,30.3c0,0,0,0.1,0,0.1c0,0.1,0,0.1,0,0.2s0,0.1,0,0.2
	c0,0,0,0.1,0,0.1l-11,30.3c-0.1,0.4-0.5,0.7-0.9,0.7c-0.1,0-0.2,0-0.3-0.1c-0.5-0.2-0.8-0.8-0.6-1.3L19.5,40z"/>
</svg></a>

        <?php endif; ?>
    </div>


</div>

