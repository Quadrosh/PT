<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;


/* @var $this yii\web\View */
/* @var $article common\models\Article */

?>
<div class="a-top_bgr_image_h1">

    <?= Alert::widget() ?>
    <section  class=" background_cover fw topSection min-h500 text-center relative"
              style=" background-image: url(/img/<?= $article->background_image ?>)"
    >
        <?php if ($article->pagehead) : ?>
        <div class="row">
            <div class="col-sm-12 content">
                <h1 <?= $article->pagehead_class ? 'class="'.$article->pagehead_class.'"' : null?>><?= nl2br($article->pagehead) ?></h1>
            </div>

        </div>
        <?php endif; ?>


        <div class="darkFilter">

        </div>
    </section>



    <div class="horizontal_line "></div>



    <?php if ($article->text) : ?>
        <p><?= nl2br($article->text)  ?></p>
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
                <?= $this->render('/article/part_views/section/'.\common\models\ArticleSection::DEFAULT_VIEW, [
                    'model' => $section,
                    'article' => $article,
                ]) ?>
            <?php endif; ?>
           
        <?php endforeach; ?>
    <?php endif; ?>


</div>
