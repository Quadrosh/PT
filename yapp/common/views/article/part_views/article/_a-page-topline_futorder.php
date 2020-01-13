<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;

$preorder = new \common\models\Preorders();


?>
<div class="a-page-topline_futorder">
    <?= Alert::widget() ?>
    <div class="row">
        <div class="col-sm-12 text-center noGP">
            <div class="headLine c_def"><span class="icon"><svg version="1.1" id="tender_zaim_svg_sm"
                                                           xmlns="http://www.w3.org/2000/svg"
                                                           xmlns:xlink="http://www.w3.org/1999/xlink"
                                                           x="0px" y="0px"
                                                           viewBox="0 0 85 70"
                                                           style="enable-background:new 0 0 85 70;"
                                                           xml:space="preserve">
<style type="text/css">
    .tender_zaim_svg_sm_st0{fill:#FFFFFF;}
</style>
                        <g>
                            <g>
                                <path class="tender_zaim_svg_sm_st0" d="M26.7,67L4.6,44.8l7.5-7.5l22.2,22.2L26.7,67z M6,44.8l20.8,20.8l6.1-6.1L12,38.7L6,44.8z"/>
                                <path class="tender_zaim_svg_sm_st0" d="M55.4,44.7H42.1v-1h13.3c2.1,0,3.7-1.7,3.7-3.7s-1.7-3.7-3.7-3.7h-8.6l-2.1-2.1
			c-1.2-1.2-2.8-1.9-4.5-1.9H31c-1.8,0-3.5,0.6-4.9,1.7l-10.2,8.3l-0.6-0.8l10.2-8.3c1.5-1.3,3.5-2,5.5-2h9.2c2,0,3.9,0.8,5.3,2.2
			l1.8,1.8h8.2c2.6,0,4.7,2.1,4.7,4.7S58,44.7,55.4,44.7z"/>
                                <path class="tender_zaim_svg_sm_st0" d="M30.7,56.9L30.3,56l2.7-1.2c1.2-0.5,2.4-0.8,3.7-0.8h18.9c1.5,0,2.9-0.6,3.9-1.7l19-20.5
			c1.5-1.6,1.5-4.1-0.1-5.7c-1.6-1.6-4.2-1.6-5.8,0L59.6,38.9l-0.7-0.7l12.8-12.8c2-2,5.2-2,7.2,0c2,2,2,5.1,0.1,7.1L60.1,53
			c-1.2,1.3-2.9,2-4.6,2H36.7c-1.1,0-2.2,0.2-3.2,0.7L30.7,56.9z"/>
                            </g>
                            <g>
                                <rect x="45.1" y="11.1" class="tender_zaim_svg_sm_st0" width="6.1" height="18.3"/>
                                <circle class="tender_zaim_svg_sm_st0" cx="48" cy="6.1" r="3"/>
                                <rect x="54.2" y="20.2" class="tender_zaim_svg_sm_st0" width="6.1" height="9.1"/>
                                <circle class="tender_zaim_svg_sm_st0" cx="57.4" cy="15.2" r="3"/>
                                <rect x="35.9" y="20.2" class="tender_zaim_svg_sm_st0" width="6.1" height="9.1"/>
                                <circle class="tender_zaim_svg_sm_st0" cx="39" cy="15.2" r="3"/>
                            </g>
                        </g>
</svg></span> <h1 class="inline"><?= Html::encode($article->h1) ?></h1> </div>
<!--            <a href="#mainOrderSection" class="goOrderButton">Получить</a>-->
        </div>
    </div>
<!--    <h1 class="text-center">--><?//= Html::encode($article->h1) ?><!--</h1>-->

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

                            <?php if ($section->header) : ?>
                                <h2 <?= $section->header_class?'class="'.$section->header_class.'"':null ?>><?= nl2br($section->header) ?></h2>
                            <?php endif; ?>
                            <?php if ($section->description) : ?>
                                <p <?= $section->description_class?'class="'.$section->description_class.'"':null ?>><?= nl2br($section->description) ?></p>
                            <?php endif; ?>
                            <?php if ($section->raw_text) : ?>
                                <p><?= nl2br($section->raw_text)  ?></p>
                            <?php endif; ?>
                            <?php if ($section->blocks) : ?>
                                <?php foreach ($section->blocks as $block) : ?>
                                    <div class="a-page_preorder_form-block_default <?= $block->color_key ?> <?= $block->custom_class ?>">
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


<?= $this->render('_futorder-form', [
    'model' => $section,
    'section' => $section,
    'article' => $article,
]) ?>