<?php

use yii\helpers\Html;


$sectionId=null;
if ($model->structure) {
    foreach (explode('&', $model->structure) as $chunk) {
        $param = explode("=", $chunk);
        if ($param[0]=='id') {
            $sectionId=$param[1];
        }
    }
}

?>


<section class="as-back_img_bordered_fw position-relative background_cover  <?= $model->color_key ?> <?= $model->custom_class ?>"
         style=" background-image: url(/img/<?= $model->background_image ?>)"
    <?= $sectionId?'id="'.$sectionId.'"':null ?>
    <?= $model->background_image_title?'title="'.$model->background_image_title.'"':null ?>
>
    <div class="color_filter"></div>
    <div class="row">
        <div class="col-sm-12 leadBox">

            <?php if ($model->header) : ?>
                <h2 class="<?= $model->header_class ?>"><?= nl2br($model->header) ?></h2>
            <?php endif; ?>
            <?php if ($model->description) : ?>
                <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= nl2br($model->description)  ?></p>
            <?php endif; ?>

            <?php if ($model->raw_text) : ?>
                <p><?php if ($model->section_image) {
                        echo Html::img('/img/'.$model->section_image,['class'=> $model->image_class, 'alt'=>$model->section_image_alt]);
                    } ?><?= nl2br($model->raw_text)  ?></p>
            <?php endif; ?>


            <?php if ($model->blocks) : ?>
                <div class="mt30 mb30">
                    <?php foreach ($model->blocks as $block) : ?>
                        <?php if ($block->view) : ?>
                            <?= $this->render('/article/part_views/block/'.$block->view, [
                                'model' => $block,
                                'article' => $article,
                                'utm' => isset($utm)?$utm:null,
                            ]) ?>
                        <?php endif; ?>
                        <?php if (!$block->view) : ?>
                            <?php if ($block->header) : ?>
                                <h3 class="<?= $block->header_class ?>"><?= $block->header ?></h3>
                            <?php endif; ?>
                            <?php if ($block->description) : ?>
                                <p class="text-center"><?= $block->description ?></p>
                            <?php endif; ?>
                            <?php if ($block->items) : ?>
                                <?php foreach ($block->items as $item) : ?>
                                    <?php if ($item->header) : ?>
                                        <h4 class="<?= $item->header_class ?>"><?= $item->header ?></h4>
                                    <?php endif; ?>
                                    <?php if ($item->description) : ?>
                                        <p class="text-center"><?= $item->description ?></p>
                                    <?php endif; ?>
                                    <?php if ($item->text) : ?>
                                        <p class="text-center"><?= $item->text ?></p>
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
            <div class="link_wrapper">
                <?php if ($model->call2action_link == 'callMe' || $model->call2action_link == 'call_me') : ?>

                        <?= $this->render('/article/part_views/article/_phone-form', [
                            'section' => $model,
                            'article' => $article,
                            'utm' => isset($utm)?$utm:null,
                        ]) ?>


                <?php endif; ?>
                <?php if ($model->call2action_link != 'callMe' && $model->call2action_link != 'call_me') : ?>
                    <?=
                    Html::a( $model->call2action_name, [$model->call2action_link],['class'=>$model->call2action_class]);
                    ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>

        </div>
    </div>

</section>






