<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LtFeel */

$this->title = 'Update Lt Feel: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lt Feels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lt-feel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
