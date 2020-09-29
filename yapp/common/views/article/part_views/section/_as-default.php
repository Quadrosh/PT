<?php

use common\models\Imagefiles;
use yii\helpers\Html;

?>


<section class="as-default <?= $model->color_key ?> <?= $model->custom_class ?>">
    <div class="row">
        <div class="  col-md-10 col-md-offset-1  col-lg-8 col-lg-offset-2">
            <?php if ($model->header) : ?>
                <h2 class="<?= $model->header_class ?>"><?= nl2br($model->header) ?></h2>
            <?php endif; ?>
            <?php if ($model->description) : ?>
                <p  <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= nl2br($model->description)  ?></p>
            <?php endif; ?>

            <?php if ($model->raw_text) : ?>
                <p <?= $model->raw_text_class?'class="'.$model->raw_text_class.'"':null ?>><?php if ($model->image) {
                        echo
                        Html::img('/img/view/'
                            . Imagefiles::TERM_CUT_OVERFLOW
                            . Imagefiles::SIZE_240_240
                            .$model->image,
                            ['class'=> $model->image_class, 'alt'=>$model->image_alt]);

                 } ?><?= nl2br($model->raw_text)  ?></p>
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
                <?php if ($model->call2action_link == 'call2master' || $model->call2action_link == 'callToMaster') : ?>
                    <div class="col-sm-12 mt30">
                        <?= $this->render('/article/part_views/article/_phone-form-to-master', [
                            'section' => $model,
                            'article' => $article,
                            'utm' => isset($utm)?$utm:null,
                        ]) ?>

                    </div>
                <?php endif; ?>

                <?php if ($model->call2action_link == 'call2psihotera' || $model->call2action_link == 'callToPsihotera') : ?>
                    <div class="col-sm-12 mt30">
                        <?= $this->render('/article/part_views/article/_phone-form-to-psihotera', [
                            'section' => $model,
                            'article' => $article,
                            'utm' => isset($utm)?$utm:null,
                        ]) ?>

                    </div>
                <?php endif; ?>


                <?php if (
                        $model->call2action_link != 'call2master' &&
                        $model->call2action_link != 'callToMaster' &&
                        $model->call2action_link != 'call2psihotera' &&
                        $model->call2action_link != 'callToPsihotera'
                ) : ?>
                    <?=
                    Html::a( $model->call2action_name, [$model->call2action_link],['class'=>$model->call2action_class]);
                    ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>

</section>






