<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LtFeelVars */

$this->title = 'Update Lt Feel Vars: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lt Feel Vars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lt-feel-vars-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
