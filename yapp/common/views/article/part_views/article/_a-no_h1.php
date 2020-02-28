<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use common\widgets\Alert;

//$preorder = new \common\models\Preorders();


?>
<div class="a-no_h1">
    <?= Alert::widget() ?>


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

