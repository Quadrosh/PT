<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;

$preorder = new \common\models\Preorders();


?>
<div class="a-page_preorder_form">
    <?= Alert::widget() ?>
    <h1 class="text-center"><?= Html::encode($article->h1) ?></h1>

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
    'article' => $article,
]) ?>