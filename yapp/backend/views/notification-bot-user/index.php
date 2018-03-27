<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Notification Bot Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notification-bot-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Notification Bot User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'master_id',
            'messenger',
            'user_id',
            'first_name',
            //'last_name',
            //'username',
            //'real_first_name',
            //'real_last_name',
            //'email:email',
            //'phone',
            //'status',
            //'bot_command',
            //'updated_at',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
