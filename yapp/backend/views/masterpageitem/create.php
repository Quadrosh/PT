<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Masterpageitem */

$this->title = 'Create Masterpageitem';
$this->params['breadcrumbs'][] = ['label' => 'Masterpageitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="masterpageitem-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_from_master_form', [
        'model' => $model,
    ]) ?>

</div>
