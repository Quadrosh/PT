<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Master', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],


            'id',
            'username',
//            'hrurl:url',
            [
                'attribute'=>'hrurl',
                'value' => function($data)
                {
                    if (Yii::$app->request->getHostName() == 'cp.psihotera.dev') {
                        $theData = '<a  href="http://psihotera.dev/master/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    } else {
                        $theData = '<a  href="http://psihotera.ru/master/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                    }
                    return $theData;
                },
                'format'=> 'html',
            ],
            'name',
            'middlename',
             'surname',
            // 'image',
             'city',
            // 'phone',
            // 'other_contacts:ntext',
            // 'address',
            // 'email:email',
            // 'site_link',
            // 'site_id',
            // 'comment:ntext',
             'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
