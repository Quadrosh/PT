<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProfessionItem */

$this->title = 'Update Profession Item: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Profession Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="profession-item-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
