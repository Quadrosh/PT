<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\PsychotherapyItem */

$this->title = 'Update Psychotherapy Item: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Psychotherapy Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="psychotherapy-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
