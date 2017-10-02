<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ItemAssign */

$this->title = 'Update Item Assign: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Item Assigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="item-assign-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
