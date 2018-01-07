<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TgBotUserPermission */

$this->title = 'Update Tg Bot User Permission: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Tg Bot User Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tg-bot-user-permission-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
