<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;
use \common\models\Article;


/* @var $article Article */


//$preorder = new \common\models\Preorders();

?>
<div class="a-article <?= $article->custom_class ?>">
    <?= Alert::widget() ?>
    <h1 class=" <?= $article->pagehead_class?$article->pagehead_class:'text-center' ?>"><?= Html::encode($article->pagehead) ?></h1>

    <?php if ($article->excerpt) : ?>
        <p><?= $article->excerpt ?></p>
    <?php endif; ?>
    <?php if ($article->excerpt_big) : ?>
        <p><?= $article->excerpt_big ?></p>
    <?php endif; ?>

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
                <?= $this->render('/article/part_views/section/_as-default', [
                    'model' => $section,
                    'article' => $article,
                ]) ?>
            <?php endif; ?>
           
        <?php endforeach; ?>
    <?php endif; ?>


</div>

