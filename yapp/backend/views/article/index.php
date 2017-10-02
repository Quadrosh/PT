<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Article', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Parse Therapeutic.ru', ['/parse/therapeutic_ru'], ['class' => 'btn btn-danger']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'list_name',
            'list_num',
            'hrurl:url',
//            'title',
            // 'description:ntext',
            // 'keywords:ntext',
            // 'text:ntext',
            // 'pagehead',
            // 'topimage',
            // 'promolink',
            // 'promoname',
            // 'imagelink',
            // 'imagelink_alt',
             'link2original',
             'author',
//             'layout',
//             'view',
            // 'master_id',
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
