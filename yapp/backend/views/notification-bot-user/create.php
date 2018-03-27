<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\NotificationBotUser */

$this->title = 'Create Notification Bot User';
$this->params['breadcrumbs'][] = ['label' => 'Notification Bot Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-bot-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
