<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tagassigns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagassign-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Tagassign', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'tag_id',
            [
                'attribute'=> 'tag_id',
                'value' => function($data)
                {
                        $theData = \common\models\Tag::find()->where(['id'=>$data['tag_id']])->one();
                        return $theData['name'];
                },
            ],
//            'article_id',
            [
                'attribute'=> 'article_id',
                'value' => function($data)
                {
                    if ($data['article_id']) {
                        $theData = \common\models\Article::find()->where(['id'=>$data['article_id']])->one();
                        if ($theData['list_name']) {
                            return $theData['list_name'];
                        } else {
                            return 'Article №'.$theData['id'];
                        }

                    }

                },
            ],
//            'master_id',
            [
                'attribute'=> 'master_id',
                'value' => function($data)
                {
                    if ($data['master_id']) {
                        $theData = \common\models\Master::find()->where(['id'=>$data['master_id']])->one();
                        if ($theData['username']) {
                            return $theData['username'];
                        } else {
                            return 'Master №'.$theData['id'];
                        }

                    }

                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
