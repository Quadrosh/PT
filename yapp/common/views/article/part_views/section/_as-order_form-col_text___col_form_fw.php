<?php

use common\models\Imagefiles;
use yii\helpers\Html;

?>


<section class="as-order_form-text_col___form_col_fw <?= $model->color_key ?> <?= $model->custom_class ?>">
    <div class="row no-gutters">
        <div class="col-sm-6 textCol">
            <?php if ($model->header) : ?>
                <h2 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h2>
            <?php endif; ?>
            <?php if ($model->description) : ?>
                <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= nl2br($model->description)  ?></p>
            <?php endif; ?>

            <?php if ($model->raw_text) : ?>
                <p <?= $model->raw_text_class?'class="'.$model->raw_text_class.'"':null ?>><?= nl2br($model->raw_text)  ?></p>
            <?php endif; ?>


            <?php if ($model->conclusion) : ?>
                <p <?= $model->conclusion_class?'class="'.$model->conclusion_class.'"':null ?>><?= nl2br($model->conclusion)  ?></p>
            <?php endif; ?>

            <?php if ($model->call2action_description) : ?>
                <p class="text-center mt50" ><?= nl2br($model->call2action_description)  ?></p>
            <?php endif; ?>
        </div>
        <div class="col-sm-6">
            <?= $this->render('/article/part_views/article/_order-form_with_labels_fw', [
                'article' => $article,
                'master' => $article->master,
                'model' => $model,
            ]) ?>
        </div>



    </div>

</section>






