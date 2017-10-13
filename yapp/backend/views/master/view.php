<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\Master */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-view">

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

    <?php Pjax::begin([
        'id' => 'mainPjax',
    ]); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'image',
            'image_alt',
            'city',
            'phone',
            'other_contacts:ntext',
            'address:ntext',
            'email:email',
//            'site_link',
//            'site_id',
            'background_image',
            'stylekey',
            'hello',
            'view',
            'layout',
            'list_add',
            'comment:ntext',
            'status',
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
//                    return \Yii::$app->formatter->asDatetime($data->updated_at. \Yii::$app->getTimeZone(), 'HH:mm dd/MM/yy');
                    return \Yii::$app->formatter->asDatetime($data->updated_at, 'HH:mm dd/MM/yyyy');

                },
                'format'=> 'html',
            ],
        ],
    ]) ?>
    <?php Pjax::end(); ?>

</div>
<section>
    <div class="container">

        <!-- image cloud -->
        <div class="row mt20 bt pt20">
            <div class="col-xs-12 text-center">
                <h4>Master image</h4>
                <!--                --><?//= Html::img('/img/th-big-'. $model->topimage, ['class'=>'articleThumb']) ?>
                <?= cl_image_tag($model->imagefile['cloudname'], [
                    "alt" => $model['image_alt'],
                    "width" => 200,
                    "height" => 200,
                    "crop" => "fill",
//                    "crop" => "thumb",
                    "gravity" => "face"
                ]); ?>
            </div>

            <div class="col-xs-12 col-sm-3 ">
                <h4>Image Cloud</h4>
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/master/cloud'],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                    'image'=>'Image',
                    'background_image'=>'Background Image',
                ])->label(false) ?>
                <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>
                <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$model->id])->label(false) ?>


                <?= Html::submitButton('Cloud', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end() ?>
            </div>

        </div>
        <!-- /image cloud -->


        <!-- назначение профессии -->
        <div class="row mt20 bt pt20">
            <?php Pjax::begin([
                'id' => 'professionAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false
            ]); ?>
            <?php
            // профессия - дата во вьюху
            $query = \common\models\ItemAssign::find()->where(['item_type'=>'pro','master_id'=>$model['id']]);
            $proDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-6">
                <h4>Профессия</h4>
                <?php $form = ActiveForm::begin([
                    'id'=>'professionAssign',
                    'action' => ['/itemassign/assignproxx?id='.$model['id']],
//                    'method' => 'post',
                    'options' => ['data-pjax' => true ]
                ]); ?>
                <?= $form->field($itemAssign, 'item_type')
                    ->hiddenInput(['value'=>'pro','id' => 'pro_assign-item_type'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'item_id')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ProfessionItem::find()->all(), 'id','name'))
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'article_id')
                    ->hiddenInput()
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'master_id')
                    ->hiddenInput(['value' => $model['id']])
                    ->label(false) ?>
                <?= Html::a('Создать', '/professionitem/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => $proDataProvider,
                    'emptyText' => '',
                    'columns'=>[
//                        'item_id',
                        [
                            'label' => 'Назначено',
                            'attribute'=>'item_id',
                            'value' => function($data)
                            {
                                $theData = \common\models\ProfessionItem::find()->where(['id'=>$data['item_id']])->one();
                                return $theData['name'];
                            },
                        ],
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
//                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => true,]);
                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'view'=>function($url,$model){
                                    return false;
                                },
                                'update'=>function($url,$model){
                                    return false;
                                },

                            ]
                        ],
                    ],
                ]);
                ?>

            </div>
            <?php Pjax::end(); ?>
        </div>
        <!-- /назначение профессии -->



        <!-- назначение меток -->
        <div class="row mt20 bt pt20">

            <?php Pjax::begin([
                'id' => 'tagAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false
            ]); ?>

            <div class=" col-sm-6">
                <h4>Метки</h4>
                <?php $form = ActiveForm::begin([
//                    'method' => 'post',
                    'action' => ['/tagassign/assignxx?type=master&id='.$model['id']],
                    'options' => ['data-pjax' => true ],
                ]); ?>
                <?= $form->field($tagAssign, 'tag_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tag::find()->orderBy('name')->all(), 'id','name'))->label(false) ?>
                <?= $form->field($tagAssign, 'article_id')->hiddenInput()->label(false) ?>
                <?= $form->field($tagAssign, 'master_id')->hiddenInput(['value' => $model['id']])->label(false) ?>
                <?= Html::a('Создать', '/tag/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Назначенные метки</th>
                        <th class="action-column">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($tags as $tag) : ?>
                        <tr >
                            <td><?= $tag['name'] ?></td>
                            <td>
                                <?php $url = '/tagassign/deletexx?id='. $tag['id'] ?>
                                <?= Html::a('','#', [
                                    'class' => 'glyphicon glyphicon-trash',
                                    'aria-label' => 'Delete',
                                    'onclick' => "
                                if (confirm('точно удалить?')) {

                                    $.ajax('$url', {
                                        type: 'POST',
                                    }).done(function() {

                                    function refresh(){
                                        $.pjax.reload({container: '#tagAssignPjax', 'timeout': 2000, 'enablePushState': false});
                                    }
                                    setTimeout(refresh, 1000)

                                    });


                                }
                                return false;
                            ",
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>


                    </tbody>
                </table>
            </div>
            <?php Pjax::end(); ?>
        </div>
        <!-- /назначение меток -->



        <!-- назначение вида психотерапии -->
        <div class="row mt20 bt pt20">
            <?php Pjax::begin([
                'id' => 'psyAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false
            ]); ?>
            <?php
            // вид психотерапии - дата во вьюху
            $query = \common\models\ItemAssign::find()->where(['item_type'=>'psy','master_id'=>$model['id']]);
            $psyDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-6">
                <h4>Вид психотерапии</h4>
                <?php $form = ActiveForm::begin([
                    'id'=>'psyAssign',
                    'action' => ['/itemassign/assignpsyxx?type=master&id='.$model['id']],
//                    'method' => 'post',
                    'options' => ['data-pjax' => true ]
                ]); ?>
                <?= $form->field($itemAssign, 'item_type')
                    ->hiddenInput(['value'=>'psy','id' => 'psy_assign-item_type'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'item_id')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PsychotherapyItem::find()->orderBy('name')->all(), 'id','name'),['id'=>'psy_assign-item_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'article_id')
                    ->hiddenInput(['value' => '','id' => 'psy_assign-article_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'master_id')
                    ->hiddenInput(['value' => $model['id'],'id' => 'psy_assign-master_id'])
                    ->label(false) ?>
                <?= Html::a('Создать', '/psychotherapyitem/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => $psyDataProvider,
                    'emptyText' => '',
                    'columns'=>[
//                        'item_id',
                        [
                            'label' => 'Назначено',
                            'attribute'=>'item_id',
                            'value' => function($data)
                            {
                                $theData = \common\models\PsychotherapyItem::find()->where(['id'=>$data['item_id']])->one();
                                return $theData['name'];
                            },
                        ],
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
//                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => true,]);
                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'view'=>function($url,$model){
                                    return false;
                                },
                                'update'=>function($url,$model){
                                    return false;
                                },

                            ]
                        ],
                    ],
                ]);
                ?>

            </div>
            <?php Pjax::end(); ?>
        </div>
        <!-- /назначение вида психотерапии -->



        <!-- назначение сайта -->
        <div class="row mt20 bt pt20">
            <?php Pjax::begin([
                'id' => 'siteAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false
            ]); ?>
            <?php
            // сайт - дата во вьюху
            $query = \common\models\ItemAssign::find()->where(['item_type'=>'site','master_id'=>$model['id']]);
            $siteDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-6">
                <h4>Сайт</h4>
                <?php $form = ActiveForm::begin([
                    'id'=>'siteAssign',
                    'action' => ['/itemassign/assignsitexx?type=master&id='.$model['id']],
//                    'method' => 'post',
                    'options' => ['data-pjax' => true ]
                ]); ?>
                <?= $form->field($itemAssign, 'item_type')
                    ->hiddenInput(['value'=>'site','id' => 'site_assign-item_type'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'item_id')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SiteItem::find()->all(), 'id','name'),['id'=>'site_assign-item_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'article_id')
                    ->hiddenInput(['value' => '','id' => 'site_assign-article_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'master_id')
                    ->hiddenInput(['value' => $model['id'],'id' => 'site_assign-master_id'])
                    ->label(false) ?>
                <?= Html::a('Создать', '/siteitem/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => $siteDataProvider,
                    'emptyText' => '',
                    'columns'=>[
//                        'item_id',
                        [
                            'label' => 'Назначено',
                            'attribute'=>'item_id',
                            'value' => function($data)
                            {
                                $theData = \common\models\SiteItem::find()->where(['id'=>$data['item_id']])->one();

                                return  Html::a($theData['name'],$theData['link']);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
//                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => true,]);
                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'view'=>function($url,$model){
                                    return false;
                                },
                                'update'=>function($url,$model){
                                    return false;
                                },

                            ]
                        ],
                    ],
                ]);
                ?>

            </div>
            <?php Pjax::end(); ?>



        </div>
        <!-- /назначение сайта -->



        <!-- назначение кнопок -->
        <div class="row mt20 bt pt20">
            <?php Pjax::begin([
                'id' => 'btnAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false
            ]); ?>
            <?php
            // кнопки - дата во вьюху
            $query = \common\models\ItemAssign::find()->where(['item_type'=>'btn','master_id'=>$model['id']]);
            $btnDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-6">
                <h4>Кнопки в списке</h4>
                <?php $form = ActiveForm::begin([
                    'id'=>'btnAssign',
                    'action' => ['/itemassign/assignbtnxx?type=master&id='.$model['id']],
//                    'method' => 'post',
                    'options' => ['data-pjax' => true ]
                ]); ?>
                <?= $form->field($itemAssign, 'item_type')
                    ->hiddenInput(['value'=>'btn','id' => 'btn_assign-item_type'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'item_id')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\BtnItem::find()->all(), 'id','name'),['id'=>'btn_assign-item_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'article_id')
                    ->hiddenInput(['value' => '','id' => 'btn_assign-article_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'master_id')
                    ->hiddenInput(['value' => $model['id'],'id' => 'btn_assign-master_id'])
                    ->label(false) ?>
                <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => $btnDataProvider,
                    'emptyText' => '',
                    'columns'=>[
//                        'item_id',
                        [
                            'label' => 'Назначено',
                            'attribute'=>'item_id',
                            'value' => function($data)
                            {
                                $theData = \common\models\BtnItem::find()->where(['id'=>$data['item_id']])->one();
                                return $theData['name'];
                            },
                        ],
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
//                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => true,]);
                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'view'=>function($url,$model){
                                    return false;
                                },
                                'update'=>function($url,$model){
                                    return false;
                                },

                            ]
                        ],
                    ],
                ]);
                ?>

            </div>
            <?php Pjax::end(); ?>
        </div>
        <!-- /назначение кнопок -->



        <!-- назначение текстов мастера -->
        <div class="row mt20 bt pt20">
            <?php Pjax::begin([
                'id' => 'masterPageAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false
            ]); ?>
            <?php
            $query = \common\models\Article::find()->where([
                'master_id'=>$model['id'],
                'link2original'=>'masterpage',
            ]);
            $masterPageDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-2">
                <h4>Тексты мастера</h4>

                <?= Html::a('Создать текст','/article/mtextcreate?master_id='.$model['id'], ['class' => 'btn btn-success btn-xs']) ?>

            </div>
            <div class="col-sm-10">

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => $masterPageDataProvider,
                    'emptyText' => '',
                    'columns'=>[

                        'list_num',
                        'list_name',
//                        'hrurl',
                        [
                            'attribute'=>'hrurl',
                            'value' => function($data)
                            {
                                $master = \common\models\Master::find()
                                    ->where(['id'=> Yii::$app->request->get('id')])
                                    ->one();
                                if (Yii::$app->request->getHostName() == 'cp.psihotera.dev') {
                                    $theData = '<a  href="http://psihotera.dev/master/'.$master['hrurl'].'/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                                } else {
                                    $theData = '<a  href="http://psihotera.ru/master/'.$master['hrurl'].'/'.$data['hrurl'].'">'.$data['hrurl'].'</a>';
                                }
                                return $theData;
                            },
                            'format'=> 'html',
                        ],
                        'status',

                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/article/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
//                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => true,]);
                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'view'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/article/view-master-text','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $newUrl,
                                        ['title' => Yii::t('yii', 'Просмотр'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'update'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/article/update','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $newUrl,
                                        ['title' => Yii::t('yii', 'Редактировать'), 'data-pjax' => '0','data-method'=>'post']);                                },

                            ]
                        ],
                    ],
                ]);
                ?>

            </div>
            <?php Pjax::end(); ?>



        </div>
        <!-- /назначение страниц мастера -->

    </div>

</section>



