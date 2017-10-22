<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Item Assigns';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-assign-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Item Assign', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'item_type',
//            'item_id',
            [
                'attribute'=> 'item_id',
                'value' => function($data)
                {
                    if ($data['item_type']== 'site') {
                        $theData = \common\models\SiteItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    }
                    elseif ($data['item_type']== 'psy') {
                        $theData = \common\models\PsychotherapyItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    }
                    elseif ($data['item_type']== 'pro') {
                        $theData = \common\models\ProfessionItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    }
                    elseif ($data['item_type']== 'btn') {
                        $theData = \common\models\BtnItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    }
                    elseif ($data['item_type']== 'masterpage') {
                        $theData = \common\models\MasterpageItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    }
                    elseif ($data['item_type']== 'city') {
                        $theData = \common\models\CityItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    }
                    elseif ($data['item_type']== 'session') {
                        $theData = \common\models\SessionTypeItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    }
                    else{
                        return $data['item_id'];
                    }

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
            'value',
            'comment',
            // 'updated_at',
            // 'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
