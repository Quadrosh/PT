<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContextAd */

$this->title = 'Create Context Ad';
$this->params['breadcrumbs'][] = ['label' => 'Context Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="context-ad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
