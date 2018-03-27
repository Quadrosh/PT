<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\NotificationBotUser */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notification Bot Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-bot-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'master_id',
            'messenger',
            'user_id',
            'first_name',
            'last_name',
            'username',
            'real_first_name',
            'real_last_name',
            'email:email',
            'phone',
            'status',
            'bot_command',
            'updated_at',
            'created_at',
        ],
    ]) ?>

</div>
