<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */



//$breadcrumbs = new \common\models\Breadcrumbs();
//$this->params['breadcrumbs'] = $breadcrumbs->construct($model->cat_ids);




?>

<div class="article_view">

    <?php if ($model->view) : ?>
        <?= $this->render('part_views/article/'.$model->view, [
            'article' => $model,
        ]) ?>
    <?php endif; ?>


    <?php if (!$model->view) : // если вюхи нет  ?>
        <?= $this->render('part_views/article/_a-article', [
            'article' => $model,
        ]) ?>
    <?php endif; ?>
</div>

