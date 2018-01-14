<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\LtFeel */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Lt Feels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-feel-view">

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
            'hrurl',
            'order_num',
            'price',
            'name:ntext',
            'description:ntext',
            'level',
            'duration',
            'cat_id',
            'warning:ntext',
            'thanx:ntext',
            'text:ntext',
            'status',
            'master_id',
            'author:ntext',
            'author_about:ntext',
//            'created_at',
            [
                'attribute'=>'created_at',
                'value'=> function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data->created_at, 'HH:mm dd/MM/yyyy');

                },
                'format'=> 'html',
            ],
//            'updated_at',
            [
                'attribute'=>'updated_at',
                'value'=> function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data->updated_at, 'HH:mm dd/MM/yyyy');

                },
                'format'=> 'html',
            ],
        ],
    ]) ?>

</div>