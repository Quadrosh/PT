<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ContextAd */

$this->title = 'Update Context Ad: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Context Ads', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="context-ad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
