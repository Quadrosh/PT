<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <div class="row">
        <div class="col-sm-4">
            <h4>import Article from file</h4>
            <?php
            $uploadmodel = new \common\models\UploadForm();
            $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/import'],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>

            <?= $form->field($uploadmodel, 'jsonFile')->fileInput()->label(false) ?>

            <?= Html::submitButton('import file', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
        <div class="col-sm-8">
            <h4>import Article from json</h4>
            <?php
            $textModel = new \common\models\TextForm();
            $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/import-json'],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>

            <?= $form->field($textModel, 'text')->textarea(['rows'=>1])->label(false) ?>

            <?= Html::submitButton('import json', ['class' => 'btn btn-primary']) ?>
            <?php $form::end() ?>
        </div>
        <div class="col-sm-12 mt50">
            <p>
                <?= Html::a('Создать статью', ['create'], ['class' => 'btn btn-success']) ?>
                <!--        --><?//= Html::a('Parse Therapeutic.ru', ['/parse/therapeutic_ru'], ['class' => 'btn btn-danger']) ?>

            </p>
        </div>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],


            'id',
            'list_name',
//            'list_num',
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
