<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lt Feels';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-feel-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lt Feel', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hrurl',
            'order_num',
            'price',
            'name:ntext',
            //'description:ntext',
            //'level',
            //'duration',
            //'cat_id',
            //'warning:ntext',
            //'thanx:ntext',
            //'text:ntext',
            //'status',
            //'master_id',
            //'author:ntext',
            //'author_about:ntext',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
