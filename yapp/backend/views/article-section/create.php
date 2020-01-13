<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ArticleSection */

$this->title = 'Create Article Section';
$this->params['breadcrumbs'][] = ['label' => 'Article Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-section-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
