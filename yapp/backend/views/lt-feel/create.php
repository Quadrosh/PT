<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LtFeel */

$this->title = 'Create Lt Feel';
$this->params['breadcrumbs'][] = ['label' => 'Lt Feels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-feel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
