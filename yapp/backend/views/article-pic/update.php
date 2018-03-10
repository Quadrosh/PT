<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticlePic */

$this->title = 'Update Article Pic: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Article Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-pic-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
