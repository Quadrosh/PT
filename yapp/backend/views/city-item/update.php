<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CityItem */

$this->title = 'Update City Item: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'City Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="city-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
