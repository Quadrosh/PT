<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LtTgBotSession */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lt Tg Bot Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-tg-bot-session-view">

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
            'tg_user_id',
            'item_id',
            'item_type',
            'description:ntext',
            'user_response:ntext',
            'remind_date',
            'remind_text:ntext',
            'created_at',
        ],
    ]) ?>

</div>
