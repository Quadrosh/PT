<?php

use common\models\Imagefiles;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use \common\models\MasterService;

/* @var $this yii\web\View */
/* @var $model common\models\Master */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p><span class="text-secondary">Баланс: </span> <?= $model->account_balance/100 ?> <small>руб.</small> </p>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
<!--        --><?//= Html::a('Index2search', ['search-index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>

    </p>

    <?php Pjax::begin([
        'id' => 'mainPjax',
    ]); ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'hrurl',
            [
                'attribute'=>'root',
                'value' => function($data)
                {
                    if (Yii::$app->request->getHostName() == 'cp.psihotera.local') {
                        $theData = '<a  href="http://psihotera.local/'.$data['root'].'">'.$data['root'].'</a>';
                    } else {
                        $theData = '<a  href="https://psihotera.ru/'.$data['root'].'">'.$data['root'].'</a>';
                    }
                    return $theData;
                },
                'format'=> 'html',
            ],


            'account_balance',
            'name',
            'middlename',
            'surname',
            'image',
            'image_alt',

            'phone',
            'other_contacts:ntext',
            //            'city',
            [
                'attribute'=>'city',
                'value' => function($data)
                {
                    if(isset($data->cities)){
                        $cities='';
                        $i = 0;
                        foreach ($data->cities as $city) {
                            if ($i == 0) {
                                $cities.=$city['name'];
                            } else {
                                $cities.=', '.$city['name'];
                            }
                            $i++;
                        }
                        return $cities;
                    }
                },
                'format'=> 'html',
            ],
            'address:ntext',
            'email:email',
//            'site_link',
//            'site_id',
            'background_image',
            'stylekey',
//            'hello:html',
            [
                'attribute'=>'hello',
                'value'=> function($data)
                {
                    return nl2br($data['hello']);

                },
                'format'=> 'html',
            ],
            'view',
            'layout',
            'list_add',
            'comment:ntext',
            'order_phone',
            'order_view',
            'order_messenger',
            'order_messenger_id',
            'order_sms_enable',
            'order_sms_count',
            'status',
            [
                 'attribute'=>'created_at', 'format'=> 'html',
                'value'=> function($data)
                {return \Yii::$app->formatter->asDatetime($data->created_at, 'HH:mm dd/MM/yyyy');},
            ],
            [
                'attribute'=>'updated_at', 'format'=> 'html',
                'value'=> function($data)
                {return \Yii::$app->formatter->asDatetime($data->updated_at, 'HH:mm dd/MM/yyyy');},
            ],
        ],
    ]) ?>
    <?php Pjax::end(); ?>

</div>
<section>
    <div class="container">

        <!--    статус состояния -->
        <div class="row mt20 bt pt20">
            <div class="col-xs-6 col-xs-offset-3 ">
                <h4>Статус: <?= $model['status']; ?></h4>
                <?php $form = yii\bootstrap\ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/master/update?id='.$model['id']],
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{beginWrapper}\n{input}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
//                         'label' => 'col-sm-4',
//                        'offset' => 'col-sm-offset-3',
                            'wrapper' => 'col-sm-12',
                            'error' => '',
                            'hint' => 'статус',
                        ],
                    ],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <?= $form->field($model, 'status',[
                    'inputTemplate' => '<div class="input-group"><span class="lRound">{input}</span><span class="input-group-btn">'.
                        '<button type="submit" class="btn rRound btn-primary">Назначить <i class="fa fa-share" aria-hidden="true"></i></button></span></div>',
                ])->dropDownList([
                    'regular'=>'regular',
                    'draft'=>'draft',
                    'premium' => 'premium',
                ]) ?>
                <?php yii\bootstrap\ActiveForm::end() ?>
            </div>
        </div>
        <!--   / статус состояния -->

        <!--    Приветствие (excerpt big)-->
        <div class="row mt20 bt pt20">
            <h6 class="text-center"><span class="grey">Приветствие:</span><br><?= $model['hello'] ? nl2br($model['hello']):'<span class="label label-warning">не заполнено</span>'; ?></h6>
            <div class="col-xs-9">
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/master/update?id='.$model['id']],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>

                <?= $form->field($model, 'hello')
                    ->textArea(['rows' => 3])
                    ->label(false) ?>
            </div>
            <div class="col-xs-3 text-center">
                <?= Html::submitButton('назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
        <!--    !Приветствие-->


        <!-- image upload -->
        <div class="row mt20 bt pt20">
            <div class="col-xs-12 text-center">
                <h4>Master image</h4>
                <!--                --><?//= Html::img('/img/th-big-'. $model->topimage, ['class'=>'articleThumb']) ?>
<!--                --><?//= cl_image_tag($model->imagefile['cloudname'], [
//                    "alt" => $model['image_alt'],
//                    "width" => 200,
//                    "height" => 200,
//                    "crop" => "fill",
////                    "crop" => "thumb",
//                    "gravity" => "face"
//                ]); ?>

                <?=  Html::img('/img/view/'
                    . Imagefiles::TERM_CUT_OVERFLOW
                    . Imagefiles::SIZE_200_200
                    .$model->imagefile['name'],
                    ['class' => 'img','style'=>'width:200px;']) ;?>

                <?php if ($model->imagefile!=null) {
                    echo  Html::a('Delete','/imagefiles/delete?id='.$model->imagefile['id'], [
                        'class' => 'btn btn-danger rot90',
                        'title' => Yii::t('yii', 'Удалить'),
                        'data-pjax' => '0','data-method'=>'post'
                    ]);
                } ?>

            </div>

            <div class="col-xs-12 col-sm-3 ">
                <h4>Image Upload</h4>
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/master/upload-image'],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                    'image'=>'Image',
                    'background_image'=>'Background Image',
                ])->label(false) ?>
                <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>
                <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$model->id])->label(false) ?>


                <?= Html::submitButton('<i class="fa fa-upload" aria-hidden="true"></i> Upload', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end() ?>
            </div>

        </div>
        <!-- /image upload -->


        <!-- назначение города -->
        <div class="row mt20 bt pt20">
            <?php Pjax::begin([
                'id' => 'cityAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false,
            ]); ?>
            <?php
            // город - дата во вьюху
            $query = \common\models\ItemAssign::find()->where(['item_type'=>'city','master_id'=>$model['id']]);
            $cityDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-6">
                <h4>Город</h4>
                <?php $form = ActiveForm::begin([
                    'id'=>'cityAssign',
                    'action' => ['/itemassign/assign-city-xx?type=master&id='.$model['id']],
                    'options' => ['data-pjax' => true ]
                ]); ?>
                <?= $form->field($itemAssign, 'item_type')
                    ->hiddenInput(['value'=>'city','id' => 'city_assign-item_type'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'item_id')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CityItem::find()->orderBy('name')->all(), 'id','name'),['id'=>'city_assign-item_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'article_id')
                    ->hiddenInput(['value' => '','id' => 'city_assign-article_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'master_id')
                    ->hiddenInput(['value' => $model['id'],'id' => 'city_assign-master_id'])
                    ->label(false) ?>
                <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/city-item/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => $cityDataProvider,
                    'emptyText' => '',
                    'columns'=>[
//                        'item_id',
                        [
                            'label' => 'Назначено',
                            'attribute'=>'item_id',
                            'value' => function($data)
                            {
                                $theData = \common\models\CityItem::find()->where(['id'=>$data['item_id']])->one();
                                return $theData['name'];
                            },
                        ],
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
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
        <!-- /назначение города -->


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
                <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/professionitem/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
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








        <!-- Услуги -->
        <div class="row mt20 bt pt20">
<!--            --><?php //Pjax::begin([
//                'id' => 'servicesPjax',
//                'timeout' => 2000,
//                'enablePushState' => false,
//            ]); ?>
            <?php

            $newServiceModel = new MasterService;
            $query = MasterService::find()
                ->where(['master_id'=>$model['id']])
                ->orderBy(['sort'=>SORT_ASC]);
            $servicesDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-6">
                <h4>Услуги</h4>
                <?php $form = ActiveForm::begin([
                    'id'=>'newServiceForm',
                    'action' => ['/master-service/create'],
//                    'action' => ['/master-service/create-async?master_id='.$model['id']],
//                    'options' => ['data-pjax' => true ]
                ]); ?>

                <?= $form->field($newServiceModel, 'master_id')
                    ->hiddenInput(['value' => $model['id'],'id' => 'newServiceForm-master_id'])
                    ->label(false) ?>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($newServiceModel, 'name')
                            ->textInput(['id' => 'newServiceForm-name'])
                            ->label('Название') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($newServiceModel, 'value')
                            ->textInput(['id' => 'newServiceForm-value'])
                            ->label('цена') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($newServiceModel, 'comment')
                            ->textInput(['id' => 'newServiceForm-comment'])
                            ->label('коммент - р/2ч') ?>
                    </div>
                </div>

                <?= Html::submitButton('Создать <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">



                <?php



                echo yii\grid\GridView::widget([
                    'dataProvider' => $servicesDataProvider,
                    'emptyText' => 'Пока нет',
                    'columns'=>[
//
//                        'name',
                        [
                            'label' => 'Название',
                            'attribute'=>'name','format' => 'raw',
                            'value' => function($data)
                            {
                                $moveUp = Html::a( '<span class="glyphicon glyphicon-arrow-up"></span>', '/master-service/move-up?id='.$data->id,
                                    [
                                        'title' => Yii::t('yii', 'Переместить вверх'),
                                        'data-method'=>'post'
                                    ]);
                                $moveDown = Html::a( '<span class="glyphicon glyphicon-arrow-down"></span>', '/master-service/move-down?id='.$data->id,
                                    [
                                        'title' => Yii::t('yii', 'Переместить вниз'),
                                        'data-method'=>'post'
                                    ]);
                                $name = $moveUp.$moveDown. $data->name;
                                return $name;
                            },
                        ],
                        'value',
                        'comment',
                        [
                            'class' => \yii\grid\ActionColumn::class,
                            'buttons' => [
                                'update'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/master-service/update','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $newUrl,
                                        ['title' => Yii::t('yii', 'Изменить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/master-service/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'view'=>function($url,$model){
                                    return false;
                                },


                            ]
                        ],
                    ],
                ]);
                ?>

            </div>
<!--            --><?php //Pjax::end(); ?>
        </div>
        <!-- /Услуги-->



        <!-- назначение вида сессии и цены  OLD -->
        <div class="row mt20 bt pt20">
            <?php Pjax::begin([
                'id' => 'sessionAssignPjax',
                'timeout' => 2000,
                'enablePushState' => false,
            ]); ?>
            <?php
            // вид сессии - дата во вьюху
            $query = \common\models\ItemAssign::find()->where(['item_type'=>'session','master_id'=>$model['id']]);
            $sessionTypeDataProvider = new \yii\data\ActiveDataProvider([
                'query'=>$query,
            ]);
            ?>
            <div class=" col-sm-6">
                <h4>Виды сессий и цена (OLD)</h4>
                <?php $form = ActiveForm::begin([
                    'id'=>'sessionAssign',
                    'action' => ['/itemassign/assign-session-xx?type=master&id='.$model['id']],
                    'options' => ['data-pjax' => true ]
                ]); ?>
                <?= $form->field($itemAssign, 'item_type')
                    ->hiddenInput(['value'=>'session','id' => 'session_assign-item_type'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'article_id')
                    ->hiddenInput(['value' => '','id' => 'session_assign-article_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'master_id')
                    ->hiddenInput(['value' => $model['id'],'id' => 'session_assign-master_id'])
                    ->label(false) ?>
                <div class="row">
                    <div class="col-sm-4">
                        <?= $form->field($itemAssign, 'item_id')
                            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SessionTypeItem::find()->orderBy('name')->all(), 'id','name'),['id'=>'session_assign-item_id'])
                            ->label('вид') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($itemAssign, 'value')
                            ->textInput(['id' => 'session_assign-master_id'])
                            ->label('цена') ?>
                    </div>
                    <div class="col-sm-4">
                        <?= $form->field($itemAssign, 'comment')
                            ->textInput(['id' => 'session_assign-master_id'])
                            ->label('коммент - р/2ч') ?>
                    </div>
                </div>




                <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/session-type-item/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-sm-6">

                <?php
                echo yii\grid\GridView::widget([
                    'dataProvider' => $sessionTypeDataProvider,
                    'emptyText' => '',
                    'columns'=>[
//                        'item_id',
                        [
                            'label' => 'Назначено',
                            'attribute'=>'item_id',
                            'value' => function($data)
                            {
                                $theData = \common\models\SessionTypeItem::find()->where(['id'=>$data['item_id']])->one();
                                return $theData['name'];
                            },
                        ],
                        'value',
                        'comment',
                        [
                            'class' => \yii\grid\ActionColumn::className(),
                            'buttons' => [
                                'update'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/update','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $newUrl,
                                        ['title' => Yii::t('yii', 'Обновить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'delete'=>function($url,$model){
                                    $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                                    return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                                },
                                'view'=>function($url,$model){
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
        <!-- /назначение вида сессии и цены -->


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
                <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/tag/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
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
                <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/psychotherapyitem/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
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
                <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/siteitem/create',['class' => 'btn btn-success btn-xs']) ?>
                <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
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
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\BtnItem::find()->all(), 'id',function($data){return $data->name.' '.$data->link;}),['id'=>'btn_assign-item_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'article_id')
                    ->hiddenInput(['value' => '','id' => 'btn_assign-article_id'])
                    ->label(false) ?>
                <?= $form->field($itemAssign, 'master_id')
                    ->hiddenInput(['value' => $model['id'],'id' => 'btn_assign-master_id'])
                    ->label(false) ?>
                <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
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
                                $btn = \common\models\BtnItem::find()->where(['id'=>$data['item_id']])->one();
                                return $btn->name . ' ' . $btn->link;
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

                <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать текст','/article/mtextcreate?master_id='.$model['id'], ['class' => 'btn btn-success btn-xs']) ?>

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



