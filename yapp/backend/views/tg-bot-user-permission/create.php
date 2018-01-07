<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TgBotUserPermission */

$this->title = 'Create Tg Bot User Permission';
$this->params['breadcrumbs'][] = ['label' => 'Tg Bot User Permissions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tg-bot-user-permission-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
