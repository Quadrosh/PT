<?php

use yii\helpers\Html;

?>


<section class="as-full_width <?= $model->color_key ?> <?= $model->custom_class ?>">

    <div class="row">
        <div class="  col-sm-12 pl0 pr0 ">

            <div class="table">
                <?php if ($model->image) : ?>
                    <div class="table-cell <?= $model->image_class ?>">
                        <?php if ($model->image) {
                            echo Html::img('/img/'.$model->image,[ 'alt'=>$model->image_alt]);
                        } ?>
                    </div>
                <?php endif; ?>

                <?php if ($model->header) : ?>
                    <div class="table-cell">
                        <h2 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h2>
                    </div>
                <?php endif; ?>
            </div>

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
                            <?php if ($block->header) : ?>
                                <h3 <?= $block->header_class?'class="'.$block->header_class.'"':null ?>><?= $block->header ?></h3>
                            <?php endif; ?>
                            <?php if ($block->description) : ?>
                                <p <?= $block->description_class?'class="'.$block->description_class.'"':null ?>><?= $block->description ?></p>
                            <?php endif; ?>
                            <?php if ($block->raw_text) : ?>
                                <p <?= $block->raw_text_class?'class="'.$block->raw_text_class.'"':null ?>><?= $block->raw_text ?></p>
                            <?php endif; ?>
                            <?php if ($block->items) : ?>
                                <?php foreach ($block->items as $item) : ?>
                                    <?php if ($item->header) : ?>
                                        <h4 <?= $item->header_class?'class="'.$item->header_class.'"':null ?>><?= $item->header ?></h4>
                                    <?php endif; ?>
                                    <?php if ($item->description) : ?>
                                        <p <?= $item->description_class?'class="'.$item->description_class.'"':null ?>><?= $item->description ?></p>
                                    <?php endif; ?>
                                    <?php if ($item->text) : ?>
                                        <p <?= $item->text_class?'class="'.$item->text_class.'"':null ?>><?= $item->text ?></p>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
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






