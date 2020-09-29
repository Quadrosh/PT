<?php

use yii\helpers\Html;

?>


<section class="as-left_image__floating_right_text_fw <?= $model->color_key ?> <?= $model->custom_class ?>">

    <div class="row no-gutters">
        <div class="col-sm-6 imageCol">
            <?php if ($model->image) {
                echo Html::img('/img/view/cutoverflow_690x690_'.$model->image,[ 'alt'=>$model->image_alt,'title'=>$model->image_title]);
            } ?>
        </div>
        <div class="col-sm-6 textCol">

            <?php if ($model->header) : ?>
                <div class="table-cell">
                    <h2 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h2>
                </div>
            <?php endif; ?>

            <?php if ($model->description) : ?>
                <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= nl2br($model->description)  ?></p>
            <?php endif; ?>

            <?php if ($model->raw_text) : ?>
                <p <?= $model->raw_text_class?'class="'.$model->raw_text_class.'"':null ?>><?= nl2br($model->raw_text)  ?></p>
            <?php endif; ?>


            <?php if ($model->blocks) : ?>
                <div class="mt30 mb30">
                    <?php foreach ($model->blocks as $block) : ?>
                        <?php if ($block->view) : ?>
                            <?= $this->render('/article/part_views/block/'.$block->view, [
                                'model' => $block,
                                'article' => $article,
                            ]) ?>
                        <?php endif; ?>

                        <?php if (!$block->view) : ?>
                            <?= $this->render('/article/part_views/block/_asb-default', [
                                'model' => $block,
                                'article' => $article,
                            ]) ?>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>


            <?php if ($model->conclusion) : ?>
                <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
            <?php endif; ?>

            <?php if ($model->call2action_description) : ?>
                <p class="text-center mt50" ><?= nl2br($model->call2action_description)  ?></p>
            <?php endif; ?>
            <?php if ($model->call2action_name) : ?>
                <?php if ($model->call2action_link == 'callMe' || $model->call2action_link == 'call_me') : ?>
                    <div class="col-md-10 col-md-offset-1  col-lg-8 col-lg-offset-2 ">
                        <?= $this->render('/article/part_views/article/_phone-form_wide', [
                            'section' => $model,
                            'article' => $article,
                        ]) ?>

                    </div>
                <?php endif; ?>
                <?php if ($model->call2action_link != 'callMe' && $model->call2action_link != 'call_me') : ?>
                    <?=
                    Html::a( $model->call2action_name, [$model->call2action_link],['class'=>$model->call2action_class]);
                    ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>



</section>






