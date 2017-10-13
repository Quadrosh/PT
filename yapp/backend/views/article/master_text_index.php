<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \common\models\Master;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
$master = Master::find()->where(['id'=>Yii::$app->request->get('master_id')])->one()
;
$this->title = 'Тексты мастера ';
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['/master/index']];
$this->params['breadcrumbs'][] = ['label' => $master['username'], 'url' => ['/master/view?id='.$master['id']]];
//$this->params['breadcrumbs'][] = ['label' => 'Тексты мастера', 'url' => ['master-texts?master_id='.$model['master_id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

<!--    <h1>--><?//= Html::encode($this->title) ?><!--</h1>-->

    <p>
        <?= Html::a('Создать текст','/article/mtextcreate?master_id='.$master['id'], ['class' => 'btn btn-success']) ?>

    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],


            'id',
            'list_num',
            'list_name',

//            'hrurl:url',
            [
                'attribute'=>'hrurl',
                'value' => function($data)
                {
                    if (Yii::$app->request->getHostName() == 'cp.psihotera.dev') {
                        $theData = '<a  href="http://psihotera.dev/article/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    } else {
                        $theData = '<a  href="http://psihotera.ru/article/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    }
                    return $theData;
                },
                'format'=> 'html',
            ],
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
//             'link2original',
//             'author',
//             'layout',
//             'view',
            // 'master_id',
             'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
