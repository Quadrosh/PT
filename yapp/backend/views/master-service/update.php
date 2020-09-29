<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MasterService */

$this->title = 'Update Master Service: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Master Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="master-service-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
