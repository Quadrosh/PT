<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */

$this->title = 'Create Article Section Block Item';
$this->params['breadcrumbs'][] = ['label' => 'Article Section Block Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-section-block-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
