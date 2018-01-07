<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LtRestriction */

$this->title = 'Update Lt Restriction: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lt Restrictions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lt-restriction-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
