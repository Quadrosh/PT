<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\LtTgBotSession */

$this->title = 'Update Lt Tg Bot Session: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Lt Tg Bot Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lt-tg-bot-session-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
