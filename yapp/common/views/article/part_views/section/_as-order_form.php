<?php

use common\models\Imagefiles;
use yii\helpers\Html;

?>


<section class="as-order_form <?= $model->color_key ?> <?= $model->custom_class ?>">
    <div class="row">
        <div class="  col-md-10 col-md-offset-1  col-lg-8 col-lg-offset-2 text-center">
            <?php if ($model->header) : ?>
                <h2 class="<?= $model->header_class ?>"><?= $model->header ?></h2>
            <?php endif; ?>
            <?php if ($model->description) : ?>
                <p class="text-left"><?= nl2br($model->description)  ?></p>
            <?php endif; ?>

            <?php if ($model->raw_text) : ?>
                <p <?= $model->raw_text_class?'class="'.$model->raw_text_class.'"':null ?>><?= nl2br($model->raw_text)  ?></p>
            <?php endif; ?>



            <?= $this->render('/article/part_views/article/_order-form', [
                'article' => $article,
                'master' => $article->master,
                'model' => $model,
            ]) ?>


            <?php if ($model->conclusion) : ?>
                <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
            <?php endif; ?>

            <?php if ($model->call2action_description) : ?>
                <p class="text-center mt50" ><?= nl2br($model->call2action_description)  ?></p>
            <?php endif; ?>


        </div>
    </div>

</section>






