<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CityItem */

$this->title = 'Create City Item';
$this->params['breadcrumbs'][] = ['label' => 'City Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
