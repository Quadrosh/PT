<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ItemAssign */

$this->title = 'Create Item Assign';
$this->params['breadcrumbs'][] = ['label' => 'Item Assigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-assign-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
