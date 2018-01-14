<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TgBotUse */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tg Bot Uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tg-bot-use-view">

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
            'user_id',
            'item_id',
            'item_type',
            'bot_name',
            'done',
            'user_result:ntext',
//            'created_at',
            [
                'attribute'=>'created_at',
                'value'=> function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data->created_at, 'HH:mm dd/MM/yyyy');

                },
                'format'=> 'html',
            ],
        ],
    ]) ?>

</div>
