<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'С этим читают... ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="btnitem-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article_id',
            'master_id',
            'a_ids',
            'm_ids',
            'created_at',
            'updated_at',
        ],
    ]); ?>
