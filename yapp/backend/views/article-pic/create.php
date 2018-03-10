<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ArticlePic */

$this->title = 'Create Article Pic';
$this->params['breadcrumbs'][] = ['label' => 'Article Pics', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-pic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
