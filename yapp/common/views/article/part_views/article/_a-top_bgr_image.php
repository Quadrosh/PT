<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;

$preorder = new \common\models\Preorders();

/* @var $this yii\web\View */
/* @var $article common\models\Article */

?>
<div class="a-top_bgr_image">
    <section  class=" background_cover fw topSection min-h500"
              style=" background-image: url(/img/<?= $article->background_image ?>)"
    >

        <div class="center_logo">
            <svg version="1.1"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 x="0px" y="0px"
                 viewBox="0 0 450 630"
                 style="enable-background:new 0 0 450 630;"
                 xml:space="preserve">
<style type="text/css">
    .briz_logo_lady_st0{fill:#FFFFFF;}
</style>
                <path class="briz_logo_lady_st0" d="M43.4,105.3c0,0,32.9-15.9,58.4-20.4c11.8-2.1,15.3-9.9,55-35.7c19.2-12.5,21.9-13.9,26.8-15.5
	c27.2-8.5,53.6,2.8,58.1,4.8c24.2,10.8,27.2,25.1,44.5,24.6c10.2-0.3,10.8-5.3,27.4-9c9.5-2.1,12.2-1.8,37.9-0.8
	c22.5,0.9,49.7-0.5,49.7-0.5s-17.5,2.1-27.9,7.2c-15.4,7.7-19,10.3-29.9,12.7c-18.2,4.1-34.2-2.5-38.7-4.3
	c-20.7-8.4-21-20.3-38.3-26c-12.3-4-22.5-1.5-39.7,2.7c-6.9,1.7-39.8,9.9-65,30.3c-4.5,3.7-12.9,10.4-25.5,14.1
	c-4.8,1.4-9.2,1.8-14.8,2.4c-13.1,1.4-18.2,11.5-43.7,13.1s-51.3,25.4-51.3,25.4S40.8,117,43.4,105.3z"/>
                <path class="briz_logo_lady_st0" d="M317.3,205.7c0.1,2.3,0.7,4.5,1.6,6.6c1,2,2.4,3.9,4.4,5c1.9,1.1,4.2,1.5,6.4,1.4c2.2-0.1,4.4-0.6,6.6-1.3
	c4.3-1.4,8.3-3.6,12.2-6c1.9-1.2,3.8-2.5,5.7-3.8c1.8-1.3,3.7-2.7,5.5-4.1c3.6-2.8,7.2-5.6,10.5-8.7c3.3-3.1,6.4-6.4,9-10.1
	c2.6-3.7,4.9-7.6,6.6-11.7c1.8-4.1,3.1-8.5,4-12.9c1.9-8.8,2.5-18,2.5-27.1c-0.1-9.1-0.9-18.2-2-27.3l-0.9-6.8l-0.2-3.5
	c0-1.2,0-2.3,0.1-3.5c0.2-4.6,1-9.2,2.1-13.7c1.1-4.5,2.5-8.8,4.2-13.1c1.6-4.3,3.5-8.5,5.6-12.5c-3.8,8.3-6.9,17-8.8,25.9
	c-1,4.4-1.6,9-1.7,13.5c0,1.1,0,2.3,0,3.4l0.3,3.4l1,6.8c1.3,9.1,2.1,18.2,2.2,27.4c0.2,9.2-0.4,18.4-2.3,27.5
	c-1,4.5-2.4,9-4.2,13.2c-1.8,4.3-4.2,8.3-6.9,12.1c-5.5,7.5-12.7,13.5-20.1,18.9c-1.8,1.4-3.7,2.7-5.6,4c-1.9,1.3-3.8,2.5-5.8,3.7
	c-4,2.3-8.1,4.5-12.5,5.8c-2.2,0.7-4.5,1.1-6.9,1.1c-2.3,0-4.7-0.4-6.7-1.7c-2-1.2-3.5-3.2-4.4-5.3
	C317.8,210.2,317.3,207.9,317.3,205.7z"/>
                <path class="briz_logo_lady_st0" d="M306.5,209.6c0.9,3.3,0.9,6.8-0.1,10.1c-0.5,1.6-1.2,3.2-2.2,4.7c-1,1.4-2.2,2.7-3.6,3.7
	c-2.8,2.1-6.1,3.4-9.4,4.2l-5,1.1c-0.8,0.2-1.6,0.4-2.4,0.6c-0.8,0.2-1.6,0.4-2.4,0.7l-2.3,0.8c-0.8,0.3-1.5,0.7-2.2,1
	c-1.4,0.8-2.9,1.6-4.1,2.6c-2.5,2.1-4.3,4.8-5.5,7.9c-0.6,1.5-1,3.1-1.5,4.7c-0.3,1.6-0.7,3.2-1,4.9l-0.4,2.5l-0.3,2.5
	c-0.2,1.7-0.4,3.3-0.5,5c-0.4,3.4-0.6,6.7-1,10.1c-0.5,3.4-1.1,6.7-2,10c-1.6,6.6-3.6,13.1-5.5,19.5c-0.9,3.2-1.7,6.5-2.3,9.8
	c-0.5,3.3-0.7,6.7,0.1,9.9c0.4,1.6,1.1,3.1,2,4.4c1,1.3,2.2,2.4,3.6,3.4c0.7,0.5,1.4,0.8,2.2,1.2c0.8,0.3,1.5,0.7,2.3,1
	c0.8,0.3,1.6,0.5,2.4,0.8l2.5,0.6c-3.3-0.5-6.7-1.3-9.7-3.1c-1.5-0.9-2.8-2-3.9-3.3c-1.1-1.4-1.9-3-2.4-4.6
	c-0.9-3.4-0.8-6.9-0.4-10.3c0.4-3.4,1.2-6.7,2-10c1.6-6.6,3.7-13,5.2-19.6c0.8-3.3,1.4-6.6,1.8-9.9c0.4-3.3,0.6-6.7,1-10.1
	c0.2-1.7,0.4-3.4,0.6-5.1l0.3-2.5l0.4-2.5c0.2-1.7,0.7-3.4,1-5c0.5-1.7,0.9-3.3,1.6-4.9c1.3-3.2,3.3-6.3,6-8.5
	c2.7-2.2,6-3.7,9.3-4.6c0.8-0.3,1.7-0.4,2.5-0.7c0.8-0.2,1.7-0.4,2.5-0.6l5-0.9c3.2-0.7,6.4-1.9,9.1-3.7c1.3-0.9,2.6-2.1,3.6-3.4
	c1-1.3,1.8-2.8,2.3-4.4C307,216.3,307.1,212.9,306.5,209.6z"/>

                <g>
                    <path class="briz_logo_lady_st0" d="M292.9,158.7c1.3-0.1,2.6-0.2,3.9-0.3c2.6-0.3,5.1-0.8,7.6-1.5c2.5-0.7,4.8-1.8,7.1-3l1.6-1.1
		c0.6-0.3,1-0.8,1.5-1.2c1-0.7,1.7-1.7,2.6-2.5c-0.9-0.6-2-1.2-3-1.6c-2.1-0.8-4.4-1-6.6-0.8c-2.2,0.2-4.4,0.8-6.5,1.6
		c-2.1,0.8-4.1,1.9-5.8,3.3c-1.8,1.4-3.3,3.1-4.4,5c-0.5,0.7-0.9,1.5-1.2,2.3C290.7,158.8,291.8,158.8,292.9,158.7z"/>
                    <path class="briz_logo_lady_st0" d="M347.8,144.9c-26.5,0-30.6,2.1-30.9,3.2c1.2,0.7,2.2,1.6,3.2,2.6c3.1,3.5,5,7.8,5.9,12.3
		c-1.1-4.4-3.1-8.7-6.3-12c-0.7-0.8-1.6-1.5-2.5-2.1c-1.4,2.1-3.2,4-5.3,5.5c-2.2,1.5-4.7,2.6-7.2,3.4c-2.6,0.7-5.2,1.2-7.8,1.3
		c-2.5,0.1-4.9,0.1-7.4-0.3c-0.5,1.2-1,2.5-1.3,3.8c-0.6,2.2-0.9,4.4-0.9,6.7c0,2.2,0.1,4.5,0.6,6.7c0.2,1,0.8,2,1.5,2.8
		c0.3,0.5,0.7,0.8,1.1,1.2c0.4,0.3,0.9,0.7,1.3,1c0.5,0.2,1,0.6,1.5,0.7l1.6,0.5l1.6,0.3c0.5,0.1,1.1,0.1,1.7,0.1
		c4.5,0.1,8.9-1.3,13.1-3.1c2.1-0.8,4.1-1.9,6.2-3c1-0.5,2-1.1,3-1.7l3-1.7c-1.9,1.2-3.8,2.5-5.8,3.7c-2,1.1-4,2.3-6.1,3.2
		c-4.2,1.9-8.6,3.4-13.3,3.4c-0.6,0-1.2,0-1.8-0.1l-1.7-0.3c-0.6-0.2-1.1-0.4-1.7-0.6c-0.6-0.2-1.1-0.5-1.6-0.8
		c-0.5-0.3-1-0.7-1.4-1c-0.4-0.4-0.9-0.8-1.2-1.3c-0.8-0.9-1.4-2-1.7-3.2c-0.5-2.3-0.7-4.6-0.6-6.9c0-2.3,0.3-4.6,0.9-6.9
		c0.2-0.6,0.4-1.3,0.6-1.9c-4,2.4-49.2,30.3-37.9,42.5c5.7,6.1,29.2,17.5,79.5-3.9C379.6,177.7,384.6,144.9,347.8,144.9z"/>
                </g>
                <path class="briz_logo_lady_st0" d="M335.1,264.5c-3.6,10.4-7.7,20.7-12.9,30.3l-2,3.6c-0.7,1.2-1.4,2.4-2.1,3.5l-2.6,4.4c0,0,0,0.1-0.1,0.1
	c-6.2,4.5-26.6,18.8-37.3,17.8c2.9-6.2,5.1-12.9,6.3-19.7c1.2-6.9,1.4-13.9,0.6-20.8c-0.9-6.9-2.6-13.7-5.7-19.9
	c2.7,6.4,4.1,13.2,4.7,20c0.6,6.8,0.2,13.7-1.1,20.4c-1.4,6.7-3.5,13.2-6.5,19.4c-2.9,6.2-6.3,12.2-9.5,18.3
	c-2.7,5.2-5.3,10.5-7.4,16c-6.9,14.7-8.5,38.7,6.3,69.2c6.5,13.4,12.7,26.4,17.9,37.2c11,24.1,9.4,44.8,6.3,56.2c0,0,0,0,0,0
	c-4.1,10.5-10.5,21-20.5,26c-22.3,11.3-55.1,19.9-59.9,21.1c-0.3,0.1-0.3,0.4-0.1,0.6c5.4,4.2,52.6,39.8,87.2,29.1
	c18.2-5.5,24.9-2.2,26.9-0.6c0.2,0.2,0.6,0,0.5-0.3c-0.4-2-1.4-7.1-3.7-16.5c-2-8.2-5.8-14.4-10.3-26.5c-4.7-12.6-6.9-22.2-7.7-25.5
	c0,0-2.3-10.1-3.4-19.3c-1.5-12.1-1.3-27-1-34.2c0.3-5.6,0.9-12.8,2.1-20.9c2.4-15.5,6.1-28.5,7.3-31.9c1.3-3.7,1.6-5.1,2.6-7.9
	c0.7-2,1.1-3.6,1.2-4c2.9-9.7,3.5-20.6,3.5-20.6c0.5-8.7-0.4-15.3-0.5-16.7c-0.2-1.7-1-7-3-13.7c-1.8-5.9-2.4-5.7-3.4-10.1
	c-1.7-7.2-1.2-12.8-1.1-14.3c0.2-2.2,0.7-5.1,2.1-9.7c1.6-5.1,4.8-12.9,10.9-22c0.7-1.2,1.4-2.4,2.1-3.6l1.9-3.7
	c5.1-9.9,9.1-20.2,12.5-30.7c1.7-5.3,3.2-10.6,4.5-16c1.3-5.4,2.6-10.8,3.5-16.2C341.7,243.4,338.7,254.1,335.1,264.5z"/>
                <path class="briz_logo_lady_st0" d="M311.7,369.6"/>
</svg>

        </div>
    </section>
    <?= Alert::widget() ?>
    <?php if ($article->h1) : ?>
    <h1 ><?= Html::encode($article->h1) ?></h1>
    <?php endif; ?>

    <div class="horizontal_line mb50"></div>

    <?php if ($article->exerpt) : ?>
        <p><?= $article->exerpt ?></p>
    <?php endif; ?>
    <?php if ($article->exerpt_big) : ?>
        <p><?= $article->exerpt_big ?></p>
    <?php endif; ?>

    <?php if ($article->raw_text) : ?>
        <p><?= nl2br($article->raw_text)  ?></p>
    <?php endif; ?>

    <?php if ($article->sections) : ?>
        <?php foreach ($article->sections as $section) : ?>

            <?php if ($section->view) : ?>
                <?= $this->render('/article/part_views/section/'.$section->view, [
                    'model' => $section,
                    'article' => $article,
                ]) ?>
            <?php endif; ?>
            <?php if (!$section->view) : ?>
                <section <?php
                if ($section->color_key || $section->custom_class) {

                    echo 'class="';
                    echo $section->color_key;
                    echo ' ';
                    echo $section->custom_class;
                    echo '"';

                }
                ?>>
                    <div class="row">
                        <div class="  col-md-10 col-md-offset-1  col-lg-8 col-lg-offset-2">

                            <?php if ($section->image) {
                                echo Html::img('/img/'.$section->image,[
                                    'alt'=>$section->image_alt,
                                    'class'=>$section->image_class,
                                ]);
                            } ?>
                            <?php if ($section->header) : ?>
                                <h2 <?= $section->header_class?'class="'.$section->header_class.'"':null ?>><?= nl2br($section->header) ?></h2>
                            <?php endif; ?>
                            <?php if ($section->description) : ?>
                                <p <?= $section->description_class?'class="'.$section->description_class.'"':null ?>><?= nl2br($section->description) ?></p>
                            <?php endif; ?>
                            <?php if ($section->raw_text) : ?>
                                <p <?= $section->raw_text_class?'class="'.$section->raw_text_class.'"':null ?>><?= nl2br($section->raw_text)  ?></p>
                            <?php endif; ?>
                            <?php if ($section->blocks) : ?>
                                <?php foreach ($section->blocks as $block) : ?>
                                    <div class="a-page-block_default <?= $block->color_key ?> <?= $block->custom_class ?>">
                                        <?php if ($block->view) : ?>
                                            <?= $this->render('/article/part_views/block/'.$block->view, [
                                                'model' => $block,
                                                'article' => $article,
                                            ]) ?>
                                        <?php endif; ?>
                                        <?php if (!$block->view) : ?>
                                            <?php if ($block->header) : ?>
                                                <h3 <?= $block->header_class?'class="'.$block->header_class.'"':null ?>><?= nl2br($block->header) ?></h3>
                                            <?php endif; ?>
                                            <?php if ($block->description) : ?>
                                                <p <?= $block->description_class?'class="'.$block->description_class.'"':null ?>><?= nl2br($block->description) ?></p>
                                            <?php endif; ?>
                                            <?php if ($block->raw_text) : ?>
                                                <p <?= $block->raw_text_class?'class="'.$block->raw_text_class.'"':null ?>><?= nl2br($block->raw_text) ?></p>
                                            <?php endif; ?>
                                            <?php if ($block->items) : ?>
                                                <?php foreach ($block->items as $item) : ?>
                                                    <?php if ($item->header) : ?>
                                                        <h4 <?= $item->header_class?'class="'.$item->header_class.'"':null ?>><?= nl2br($item->header) ?></h4>
                                                    <?php endif; ?>
                                                    <?php if ($item->description) : ?>
                                                        <p <?= $item->description_class?'class="'.$item->description_class.'"':null ?>><?= nl2br($item->description) ?></p>
                                                    <?php endif; ?>
                                                    <?php if ($item->text) : ?>
                                                        <p <?= $item->text_class?'class="'.$item->text_class.'"':null ?>><?= nl2br($item->text) ?></p>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <?php if ($section->conclusion) : ?>
                                <p <?= $section->conclusion_class?'class="'.$section->conclusion_class.'"':null ?>><?= nl2br($section->conclusion)  ?></p>
                            <?php endif; ?>

                            <div <?= $section->call2action_class?'class="'.$section->call2action_class.'"':null ?>>
                                <?php if ($section->call2action_description) : ?>
                                    <p class="text-center mt50" ><?= nl2br($section->call2action_description)  ?></p>
                                <?php endif; ?>
                                <?php if ($section->call2action_name) : ?>
                                    <?php if ($section->call2action_link == 'callMe') : ?>
                                        <div class="col-sm-12 ">
                                            <?= $this->render('/article/part_views/article/_phone-form', [
                                                'section' => $section,
                                                'article' => $article,
                                                'utm' => isset($utm)?$utm:null,
                                            ]) ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if ($section->call2action_link != 'callMe') : ?>
                                        <?=
                                        Html::a( $section->call2action_name, [$section->call2action_link],['class'=>$section->call2action_class]);
                                        ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>



                </section>
            <?php endif; ?>
           
        <?php endforeach; ?>
    <?php endif; ?>


</div>
