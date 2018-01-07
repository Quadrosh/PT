<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LtTgBotSessionVars */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lt Tg Bot Session Vars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-tg-bot-session-vars-view">

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
            'lo_bot_session_id',
            'step_number',
            'step_text:ntext',
            'user_response:ntext',
            'created_at',
        ],
    ]) ?>

</div>
