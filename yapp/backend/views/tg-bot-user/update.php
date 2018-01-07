<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TgBotUser */

$this->title = 'Update Tg Bot User: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tg Bot Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tg-bot-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
