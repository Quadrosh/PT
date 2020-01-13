<?php

use common\models\Imagefiles;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use \common\models\Article;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Статьи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="article-view">

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
<!--        --><?//= Html::a('Index2search', ['search-index', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
        <?= Html::a('Export file', ['/article/export', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Точно уже экспортировать статью?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Export json', ['/article/export-json', 'id' => $model->id], [
            'class' => 'btn btn-success',
            'data' => [
                'confirm' => 'Точно уже экспортировать статью?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<!--    <p>-->
<!--        --><?//= Html::a('Создать категорию', ['/menu/create',
//            'url'=>$model->hrurl,
//            'name'=>$model->list_name], ['class' => 'btn btn-success btn-xs']) ?>
<!--        --><?//= Html::a('Создать страницу', ['/pages/create',
//            'hrurl'=>$model->hrurl,
//            'status'=>'article'], ['class' => 'btn btn-success btn-xs']) ?>
<!--    </p>-->



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'type',
            'status',
            'list_name',
            'list_num',
            [
                'attribute'=>'hrurl',
                'value' => function($model)
                {
                    if (Yii::$app->request->getHostName() == 'cp.psihotera.local') {
                        $theData = '<a  href="http://psihotera.local/article/'.$model['hrurl'].'">'.$model['hrurl'].'</a>';
                    } else {
                        $theData = '<a  href="http://psihotera.ru/article/'.$model['hrurl'].'">'.$model['hrurl'].'</a>';
                    }
                    return $theData;
                },
                'format'=> 'html',
            ],
            'title',
            'description:ntext',
            'keywords:ntext',
            'pagehead',
            [
                'attribute'=>'text',
                'value' => function($model)
                {
                    return nl2br($model['text']);
                },
                'format'=> 'html',
            ],
            'excerpt',
            'excerpt_big',
            'topimage',
            'topimage_alt',
            'topimage_title',
            'background_image',
            'background_image_title',
            'thumbnail_image',
            'thumbnail_image_alt',
            'thumbnail_image_title',
            'call2action_description',
            'call2action_name',
            'call2action_link',
            'call2action_class',
            'call2action_comment',
            'object_type',
            'object_id',

            'promolink',
            'promoname',
            'imagelink',
            'imagelink_alt',
            'link2original',
            'author',
            'layout',
            'view',
            'master_id',
            [
                'attribute'=>'created_at', 'format'=> 'html',
                'value' => function($data)
                {return \Yii::$app->formatter->asDatetime($data['created_at'], 'dd/MM/yy HH:mm');},
            ],
            [
                'attribute'=>'updated_at','format'=> 'html',
                'value' => function($data)
                {return \Yii::$app->formatter->asDatetime($data['updated_at'], 'dd/MM/yy HH:mm');},
            ],
        ],
    ]) ?>

</div>


<section>
    <!-- изменение текста -->
    <div class="row mt20 bt pt20">

        <?php $form = ActiveForm::begin([
            'id'=>'changeText',
            'action' => ['/article/update?id='.$model['id']],
            'options' => ['data-pjax' => true ]
        ]); ?>
        <div class="col-sm-12">
            <?= $form->field($model, 'text')
                ->textarea(['rows' => 4,'maxlength' => true, 'id'=>'changeText-text'])
                ->label('Изменение текста')
            ?>
        </div>
        <div class="col-sm-3">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary ']) ?>
        </div>
        <?php ActiveForm::end() ?>

        <?php $form = ActiveForm::begin([
            'id'=>'changeSubString',
            'action' => ['/article/change-sub-str?id='.$model['id']],
        ]); $fromTo = new \common\models\FromToForm()?>
        <div class="col-sm-3">
            <?= $form->field($fromTo, 'from')->textInput(['placeholder' => 'from'])->label(false) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($fromTo, 'to')->textInput(['placeholder' => 'to'])->label(false) ?>
        </div>
        <div class="col-sm-3">
            <?= Html::submitButton('Заменить', ['class' => 'btn btn-success ']) ?>
        </div>

        <?php ActiveForm::end() ?>

    </div>
    <!-- /изменение текста -->


    <!--   hrurl -->
    <div class="row mt20 bt pt20">
        <h6 class="text-center"><span class="grey">Текущий значение hrurl:</span><br><?= $model['hrurl'] ? $model['hrurl']:'<span class="label label-warning">не заполнено</span>'; ?></h6>
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/update?id='.$model['id']],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>
            <?= $form->field($model, 'hrurl')
                ->textInput(['value'=>Article::cyrillicToLatin($model['list_name'], 210, true).'-'.Article::latinAuthor($model['id'])])
                ->label(false) ?>
        </div>
        <div class="col-xs-3 text-right">
            <?= Html::submitButton('назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary']) ?>
        </div>
            <?php ActiveForm::end() ?>
    </div>
    <!--   / hrurl -->


    <!--   / малая выдержка (excerpt)-->
    <div class="row mt20 bt pt20">
        <h6 class="text-center"><span class="grey">Текущий текст малой выдержки:</span><br><?= $model['excerpt'] ? $model['excerpt']:'<span class="label label-warning">не заполнено</span>'; ?></h6>
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/update?id='.$model['id']],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>

            <?= $form->field($model, 'excerpt')
                ->textArea(['value'=>Article::excerpt($model['text'], 180),'rows' => 2])
                ->label(false) ?>
        </div>
        <div class="col-xs-3 text-right">
            <?= Html::submitButton('назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
    <!--   / малая выдержка (excerpt)-->


    <!--    большая выдержка (excerpt big)-->
    <div class="row mt20 bt pt20">
        <h6 class="text-center"><span class="grey">Текущий текст большой выдержки:</span><br><?= $model['excerpt_big'] ? $model['excerpt_big']:'<span class="label label-warning">не заполнено</span>'; ?></h6>
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/update?id='.$model['id']],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>

            <?= $form->field($model, 'excerpt_big')
                ->textArea(['value'=>Article::excerpt($model['text'], 400),'rows' => 3])
                ->label(false) ?>
        </div>
        <div class="col-xs-3 text-right">
            <?= Html::submitButton('назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary']) ?>
        </div>
        <?php ActiveForm::end() ?>
    </div>
    <!--    большая выдержка (excerpt big)-->


    <!--    статус состояния -->
    <div class="row mt20 bt pt20">
        <div class="col-xs-6 col-xs-offset-3 ">
            <h4>Статус: <?= $model['status']; ?></h4>
            <?php $form = yii\bootstrap\ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/update?id='.$model['id']],
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
                Article::STATUS_UNREAD =>'Непроверено',
                Article::STATUS_IN_PROCESS =>'В работе',
                Article::STATUS_PUBLISHED =>'Опубликовано',
            ]) ?>
            <?php yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
    <!--   / статус состояния -->







    <!--    Назначение картинки -->
    <div class="row mt20 bt pt20">
        <div class="col-xs-12 text-center">
            <h4>article image</h4>
<!--       --><?//= cl_image_tag($model->topimagefile['cloudname'], [
//                "alt" => $model['topimage_alt'],
////                            "width" => 70,
//                "height" => 400,
//                "crop" => "fill"
//            ]); ?>

            <?php if ($model->topimagefile) {
               echo Html::img('/img/view/'
                    . Imagefiles::TERM_CUT_OVERFLOW
                    . Imagefiles::SIZE_200_200
                    .$model->topimagefile['name'],
                    ['class' => 'img','style'=>'width:200px;']) ;
            } ?>

            <?php if ($model->topimagefile!=null) {
                echo  Html::a('Delete','/imagefiles/delete?id='.$model->topimagefile['id'], [
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
                'action' => ['/article/upload-image'],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>
            <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                'topimage'=>'Top Image',
                'background_image'=>'Background Image',
                'thumbnail_image'=>'Thumbnail Image',
            ])->label(false) ?>
            <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>
            <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$model->id])->label(false) ?>

            <?= Html::submitButton('<i class="fa fa-upload" aria-hidden="true"></i> Upload', ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
    <!--   /Назначение картинки -->





    <!--    Назначение меток-->
    <div class="row mt20 bt pt20">
        <?php Pjax::begin([
            'id' => 'tagAssignPjax',
            'timeout' => 2000,
            'enablePushState' => false
        ]); ?>
        <div class=" col-sm-6">
            <h4>Метки</h4>
            <?php $form = ActiveForm::begin([
                'action' => ['/tagassign/assignxx?type=article&id='.$model['id']],
                'options' => ['data-pjax' => true ],
            ]); ?>
            <?= $form->field($tagAssign, 'tag_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tag::find()->orderBy('name')->all(), 'id','name'))->label(false) ?>
            <?= $form->field($tagAssign, 'article_id')->hiddenInput(['value' => $model['id']])->label(false) ?>
            <?= $form->field($tagAssign, 'master_id')->hiddenInput()->label(false) ?>
            <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/tag/create',['class' => 'btn btn-success btn-xs']) ?>
            <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
            <?php ActiveForm::end() ?>
        </div>
        <div class="col-sm-6">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Назначено</th>
                    <th class="action-column">&nbsp;</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($tags as $tag) : ?>
                    <tr >
                        <td><?= $tag['name'] ?></td>
                        <td>
                            <a href="/tagassign/delete?id=<?= $tag['id'] ?>"
                                title="Delete" aria-label="Delete"
                                data-confirm="Are you sure you want to delete this item?"
                                data-pjax="0"
                                data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php Pjax::end(); ?>
    </div>
    <!--   /Назначение меток-->



    <!--    назначение вида психотерапии-->
    <div class="row mt20 bt pt20">
        <?php Pjax::begin([
            'id' => 'psyAssignPjax',
            'timeout' => 2000,
            'enablePushState' => false
        ]); ?>
        <?php
        // вид психотерапии - дата во вьюху
        $query = \common\models\ItemAssign::find()->where(['item_type'=>'psy','article_id'=>$model['id']]);
        $psyDataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query,
        ]);
        ?>
        <div class=" col-sm-6">
            <h4>Вид психотерапии</h4>
            <?php $form = ActiveForm::begin([
                'id'=>'psyAssign',
                'action' => ['/itemassign/assignpsyxx?type=article&id='.$model['id']],
                'options' => ['data-pjax' => true ]
            ]); ?>
            <?= $form->field($itemAssign, 'item_type')
                ->hiddenInput(['value'=>'psy','id' => 'psy_assign-item_type'])
                ->label(false) ?>
            <?= $form->field($itemAssign, 'item_id')
                ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PsychotherapyItem::find()->orderBy('name')->all(), 'id','name'),['id'=>'psy_assign-item_id'])
                ->label(false) ?>
            <?= $form->field($itemAssign, 'article_id')
                ->hiddenInput(['value' => $model['id'],'id' => 'psy_assign-article_id'])
                ->label(false) ?>
            <?= $form->field($itemAssign, 'master_id')
                ->hiddenInput(['value' => '','id' => 'psy_assign-master_id'])
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
    <!--   /назначение вида психотерапии-->



    <!-- назначение сайта -->
    <div class="row mt20 bt pt20">
        <?php Pjax::begin([
            'id' => 'siteAssignPjax',
            'timeout' => 2000,
            'enablePushState' => false
        ]); ?>
        <?php
        // сайт - дата во вьюху
        $query = \common\models\ItemAssign::find()->where(['item_type'=>'site','article_id'=>$model['id']]);
        $siteDataProvider = new \yii\data\ActiveDataProvider([
            'query'=>$query,
        ]);
        ?>
        <div class=" col-sm-6">
            <h4>Сайт</h4>
            <?php $form = ActiveForm::begin([
                'id'=>'siteAssign',
                'action' => ['/itemassign/assignsitexx?type=article&id='.$model['id']],
//                    'method' => 'post',
                'options' => ['data-pjax' => true ]
            ]); ?>
            <?= $form->field($itemAssign, 'item_type')
                ->hiddenInput(['value'=>'site','id' => 'site_assign-item_type'])
                ->label(false) ?>
            <?= $form->field($itemAssign, 'item_id')
                ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SiteItem::find()->all(), 'id','name'),['id'=>'psy_assign-item_id'])
                ->label(false) ?>
            <?= $form->field($itemAssign, 'article_id')
                ->hiddenInput(['value' => $model['id'],'id' => 'site_assign-article_id'])
                ->label(false) ?>
            <?= $form->field($itemAssign, 'master_id')
                ->hiddenInput(['value' => '','id' => 'site_assign-master_id'])
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

<!--    </div>-->



    <?= Html::a('Добавить секцию '.'<i class="glyphicon glyphicon-menu-right"></i>','/article-section/create?article_id='.$model->id, ['class' => 'mt50 btn btn-success']) ?>

</section>


    <section class="mt50 article-sections">

        <?php if ($model->sections) : ?>
            <ol class="breadcrumb">
                <li>Управление - секции <?php if ($model->view) {echo ' | article view => '.$model->view;} ?> </li>
            </ol>
            <?php $sectionNum=1; foreach ($model->sections as $section) : ?>
                <div class="row admin_section_head">
                    <div class="col-sm-4">
                        Секция: <?= $sectionNum ?>. <?= $section->sort?'<span style="color:rgba(0,0,0,.3);"><sup class="glyphicon glyphicon-sort-by-attributes"></sup>'.$section->sort.'</span>':'' ?> <span class="text-danger"><?= $section->code_name ?></span> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-arrow-up"></span>', '/article-section/move-up?id='.$section->id,
                            [
                                'title' => Yii::t('yii', 'Переместить вверх'),
                                'data-method'=>'post'
                            ]); ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-arrow-down"></span>', '/article-section/move-down?id='.$section->id,
                            [
                                'title' => Yii::t('yii', 'Переместить вниз'),
                                'data-method'=>'post'
                            ]); ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section/update?id='.$section->id,
                            [
                                'title' => Yii::t('yii', 'Редактировать секцию'),
                                'data-method'=>'post'
                            ]); ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-open-file"></span>', '/article-section-block/create?section_id='.$section->id,
                            [
                                'title' => Yii::t('yii', 'Добавить блок'),
                                'data-method'=>'post'
                            ]); ?>
                        <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', '/article-section/delete?id='.$section->id,
                            [
                                'title' => Yii::t('yii', 'Удалить секцию'),
                                'data-confirm' =>'Точно удалить секцию со всеми блоками и block items?',
                                'data-method'=>'post'
                            ]); ?>
                    </div>
                    <div class="col-sm-8">
                        <?php $form = ActiveForm::begin([
                            'method' => 'post',
                            'action' => ['/article-section/upload'],
                            'options' => ['enctype' => 'multipart/form-data'],
                        ]); ?>
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                                    'image'=>'Image',
                                    'background_image'=>'Background Image',
                                    'thumbnail_image'=>'Thumbnail Image',

                                ])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($uploadmodel, 'imageFile')
                                    ->fileInput(['class'=>'fileField'])->label(false) ?>
                                <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$section->id])->label(false) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= Html::submitButton('Upload', ['class' => 'btn btn-success btn-xs']) ?>
                            </div>
                        </div>
                        <?php ActiveForm::end() ?>
                    </div>
                </div>

                <ul class="admin_section_ul">
                    <li>ID - <?= $section->id ?><?= $section->sort?', Sort - '.$section->sort:'' ?></li>
                    <?= $section->header?'<li> Header - '.$section->header.'</li>':'' ?>
                    <?= $section->header_class?'<li> Header - '.$section->header_class.'</li>':'' ?>
                    <?= $section->description?'<li> Description - '.$section->description.'</li>':'' ?>
                    <?= $section->raw_text?'<li> Raw Text - '.\common\models\Article::excerpt($section->raw_text,100).'</li>':'' ?>

                    <?= $section->image?'<li>Image - '
                        .Html::img('/img/view/'
                            . Imagefiles::TERM_CUT_OVERFLOW
                            . Imagefiles::SIZE_50_50
                            .$section->image,
                            ['class' => 'gridThumb'])
                        .'<sup>'.$section->image.'</sup>'
                        .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                            '/article-section/delete-image?id='.$section->id.'&propertyName=image',
                            [
                                'title' => Yii::t('yii', 'Удалить image'),
                                'data-confirm' =>'Точно удалить?',
                                'data-method'=>'post'
                            ])
                        .'</li>':'' ?>
                    <?= $section->image_alt?'<li class="text-success"> Image Alt - '.$section->image_alt.'</li>':'' ?>
                    <?= $section->image_title?'<li class="text-warning"> Image Title - '.$section->image_title.'</li>':'' ?>
                    <?= $section->background_image?'<li> Background Image - '
                        .Html::img('/img/view/'
                            . Imagefiles::TERM_CUT_OVERFLOW
                            . Imagefiles::SIZE_50_50
                            .$section->background_image,
                            ['class' => 'gridThumb'])
                        .'<sup>'.$section->background_image.'</sup>'
                        .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                            '/article-section/delete-image?id='.$section->id.'&propertyName=background_image',
                            [
                                'title' => Yii::t('yii', 'Удалить background_image'),
                                'data-confirm' =>'Точно удалить?',
                                'data-method'=>'post'
                            ])
                        .'</li>':'' ?>
                    <?= $section->background_image_title?'<li class="text-warning">Background Image Title - '.$section->background_image_title.'</li>':'' ?>

                    <?= $section->thumbnail_image?'<li> Thumbnail Image - '
                        .Html::img('/img/view/'
                            . Imagefiles::TERM_CUT_OVERFLOW
                            . Imagefiles::SIZE_50_50
                            .$section->thumbnail_image,
                            ['class' => 'gridThumb'])
                        .'<sup>'.$section->thumbnail_image.'</sup>'
                        .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                            '/article-section/delete-image?id='.$section->id.'&propertyName=thumbnail_image',
                            [
                                'title' => Yii::t('yii', 'Удалить thumbnail_image'),
                                'data-confirm' =>'Точно удалить?',
                                'data-method'=>'post'
                            ])
                        .'</li>':'' ?>
                    <?= $section->thumbnail_image_alt?'<li class="text-success">Thumbnail Image Alt - '.$section->thumbnail_image_alt.'</li>':'' ?>
                    <?= $section->thumbnail_image_title?'<li class="text-warning">Thumbnail Image Title - '.$section->thumbnail_image_title.'</li>':'' ?>
                    <?= $section->call2action_name?'<li> Call2Action Name - '.$section->call2action_name.'</li>':'' ?>
                    <?= $section->call2action_link?'<li> Call2Action Link - '.$section->call2action_link.'</li>':'' ?>
                    <?= $section->call2action_class?'<li> Call2Action Class - '.$section->call2action_class.'</li>':'' ?>
                    <?= $section->call2action_description?'<li> Call2Action Description - '.$section->call2action_description.'</li>':'' ?>
                    <?= $section->call2action_comment?'<li> Call2Action Comment - '.$section->call2action_comment.'</li>':'' ?>
                    <?= $section->view?'<li> View - '.$section->view.'</li>':'' ?>
                    <?= $section->color_key?'<li> Color Key - '.$section->color_key.'</li>':'' ?>
                    <?= $section->structure?'<li> Structure - '.$section->structure.'</li>':'' ?>
                    <?= $section->custom_class?'<li> Custom Class - '.$section->custom_class.'</li>':'' ?>

                    <?php if ($section->blocks) : ?>
                        <li>Блоки
                            <?php $blockNum=1; foreach ($section->blocks as $block) : ?>
                                <ul>
                                    <div class="row mt20">
                                        <div class="col-sm-4">
                                            Блок <?= $blockNum ?>. <?= $block->sort?'<sup class="glyphicon glyphicon-sort-by-attributes"></sup>'.$block->sort:'' ?> <span class="text-danger"><?= $block->code_name ?></span> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section-block/update?id='.$block->id,
                                                [
                                                    'title' => Yii::t('yii', 'Редактировать блок'),
                                                    'data-method'=>'post'
                                                ]); ?> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-open-file"></span>', '/article-section-block-item/create?block_id='.$block->id,
                                                [
                                                    'title' => Yii::t('yii', 'Добавить block item'),
                                                    'data-method'=>'post'
                                                ]); ?>
                                            <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', '/article-section-block/delete?id='.$block->id,
                                                [
                                                    'title' => Yii::t('yii', 'Удалить блок'),
                                                    'data-confirm' =>'Точно удалить со всеми block items?',
                                                    'data-method'=>'post'
                                                ]); ?>
                                        </div>
                                        <div class="col-sm-8">
                                            <?php $form = ActiveForm::begin([
                                                'method' => 'post',
                                                'action' => ['/article-section-block/upload'],
                                                'options' => ['enctype' => 'multipart/form-data'],
                                            ]); ?>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                                                        'image'=>'Image',
                                                        'background_image'=>'Background Image',
                                                        'thumbnail_image'=>'Thumbnail Image',

                                                    ])->label(false) ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <?= $form->field($uploadmodel, 'imageFile')
                                                        ->fileInput(['class'=>'fileField'])->label(false) ?>
                                                    <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$block->id])->label(false) ?>
                                                </div>
                                                <div class="col-sm-4">
                                                    <?= Html::submitButton('Upload', ['class' => 'btn btn-success btn-xs']) ?>
                                                </div>
                                            </div>
                                            <?php ActiveForm::end() ?>
                                        </div>
                                    </div>


                                    <?= $block->header?'<li> Header - '.$block->header.'</li>':'' ?>
                                    <?= $block->header_class?'<li> Header - '.$block->header_class.'</li>':'' ?>
                                    <?= $block->description?'<li> Description - '.$block->description.'</li>':'' ?>
                                    <?= $block->raw_text?'<li> Raw Text '.
                                        Html::a( '<span class="glyphicon glyphicon-fullscreen"></span>',
                                            '/article-section-block/raw-text-to-items?id='.$block->id,
                                            [
                                                'title' => Yii::t('yii', 'raw text to items (each line to item)'),
                                                'data-confirm' =>'Точно конвертировать текст в items построчно?',
                                                'data-method'=>'post'
                                            ]).' '.
                                        Html::a( '<span class="glyphicon glyphicon-th-list"></span>',
                                            ['/article-section-block/raw-text-to-items',
                                                'id'=>$block->id,
                                                'mode'=>2,
                                            ],
                                            [
                                                'title' => Yii::t('yii', 'raw text to items mode 2 (1-st line - head, next lines - text, delimeter - empty string)'),
                                                'data-confirm' =>'Точно конвертировать текст в items режим 2? (1 строка заголовок, 1 строка тело, разделитель пустая строка.) ?',
                                                'data-method'=>'post'
                                            ]).
                                        ' - '.\common\models\Article::excerpt($block->raw_text,100).'</li>':'' ?>
                                    <?php
                                    $blockImageLi='';
                                    if ($block->image) {
                                        if (substr(trim($block->image),0,4)=='<svg') {
                                            $blockImageLi = '<li class="viewImageSvg"> Image <sup>svg</sup> - '.$block->image.'</li>';
                                        } else {
                                            $blockImageLi = '<li> Image - '
                                                .Html::img('/img/view/'
                                                    . Imagefiles::TERM_CUT_OVERFLOW
                                                    . Imagefiles::SIZE_50_50
                                                    . $block->image,
                                                    ['class' => 'gridThumb'])
                                                .'<sup>'.$block->image.'</sup>'
                                                .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                                    '/article-section-block/delete-image?id='.$block->id.'&propertyName=image',
                                                    [
                                                        'title' => Yii::t('yii', 'Удалить image'),
                                                        'data-confirm' =>'Точно удалить?',
                                                        'data-method'=>'post'
                                                    ])
                                                .'</li>';
                                        }
                                    }
                                    ?>
                                    <?= $block->image?$blockImageLi:'' ?>
                                    <?= $block->image_alt?'<li class="text-success"> Image Alt - '.$block->image_alt.'</li>':'' ?>
                                    <?= $block->image_title?'<li class="text-warning"> Image Title - '.$block->image_title.'</li>':'' ?>

                                    <?= $block->background_image?'<li> Background Image - '
                                        .Html::img('/img/view/'
                                            . Imagefiles::TERM_CUT_OVERFLOW
                                            . Imagefiles::SIZE_50_50
                                            . $block->background_image,
                                            ['class' => 'gridThumb'])
                                        .'<sup>'.$block->background_image.'</sup>'
                                        .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                            '/article-section-block/delete-image?id='.$block->id.'&propertyName=background_image',
                                            [
                                                'title' => Yii::t('yii', 'Удалить background_image'),
                                                'data-confirm' =>'Точно удалить?',
                                                'data-method'=>'post'
                                            ])
                                        .'</li>':'' ?>
                                    <?= $block->background_image_title?'<li class="text-warning"> Background Image Title - '.$block->background_image_title.'</li>':'' ?>

                                    <?= $block->thumbnail_image?'<li> Thumbnail Image - '
                                        .Html::img('/img/view/'
                                            . Imagefiles::TERM_CUT_OVERFLOW
                                            . Imagefiles::SIZE_50_50
                                            . $block->thumbnail_image,
                                            ['class' => 'gridThumb'])
                                        .'<sup>'.$block->thumbnail_image.'</sup>'
                                        .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                            '/article-section-block/delete-image?id='.$block->id.'&propertyName=thumbnail_image',
                                            [
                                                'title' => Yii::t('yii', 'Удалить thumbnail_image'),
                                                'data-confirm' =>'Точно удалить?',
                                                'data-method'=>'post'
                                            ])
                                        .'</li>':'' ?>
                                    <?= $block->thumbnail_image_alt?'<li class="text-success"> Thumbnail Image Alt - '.$block->thumbnail_image_alt.'</li>':'' ?>
                                    <?= $block->thumbnail_image_title?'<li class="text-warning"> Thumbnail Image Title - '.$block->thumbnail_image_title.'</li>':'' ?>
                                    <?= $block->call2action_name?'<li> Call2Action Name - '.$block->call2action_name.'</li>':'' ?>
                                    <?= $block->call2action_link?'<li> Call2Action Link - '.$block->call2action_link.'</li>':'' ?>
                                    <?= $block->call2action_class?'<li> Call2Action Class - '.$block->call2action_class.'</li>':'' ?>
                                    <?= $block->call2action_description?'<li> Call2Action Description - '.$block->call2action_description.'</li>':'' ?>
                                    <?= $block->call2action_comment?'<li> Call2Action Comment - '.$block->call2action_comment.'</li>':'' ?>
                                    <?= $block->view?'<li> View - '.$block->view.'</li>':'' ?>
                                    <?= $block->color_key?'<li> Color Key - '.$block->color_key.'</li>':'' ?>
                                    <?= $block->structure?'<li> Structure - '.$block->structure.'</li>':'' ?>
                                    <?= $block->custom_class?'<li> Custom Class - '.$block->custom_class.'</li>':'' ?>
                                    <?= $block->accent?'<li> Accent - '.$block->accent.'</li>':'' ?>
                                    <?php if ($block->items) : ?>
                                        <li> Block Items
                                            <?php $itemNum=1; foreach ($block->items as $item) : ?>
                                                <ul>
                                                    <div class="row mt20">
                                                        <div class="col-sm-4">
                                                            Пункт <?= $itemNum ?> <?= $item->sort?'<sup class="glyphicon glyphicon-sort-by-attributes"></sup>'.$item->sort:'' ?> <span class="text-danger"><?= $item->code_name ?></span> <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', '/article-section-block-item/update?id='.$item->id,
                                                                [
                                                                    'title' => Yii::t('yii', 'Редактировать item'),
                                                                    'data-method'=>'post'
                                                                ]); ?>
                                                            <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', '/article-section-block-item/delete?id='.$item->id,
                                                                [
                                                                    'title' => Yii::t('yii', 'Удалить item'),
                                                                    'data-confirm' =>'Точно удалить?',
                                                                    'data-method'=>'post'
                                                                ]); ?>
                                                            <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-asterisk">2</span>', '/article-section-block-item/multiply?id='.$item->id.'&qnt=2',
                                                                [
                                                                    'title' => Yii::t('yii', 'добавить 1 item'),
                                                                    'data-method'=>'post'
                                                                ]); ?>
                                                            <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-asterisk">3</span>', '/article-section-block-item/multiply?id='.$item->id.'&qnt=3',
                                                                [
                                                                    'title' => Yii::t('yii', 'добавить 3 items'),
                                                                    'data-method'=>'post'
                                                                ]); ?>
                                                            <?= \yii\helpers\Html::a( '<span class="glyphicon glyphicon-asterisk">5</span>', '/article-section-block-item/multiply?id='.$item->id.'&qnt=5',
                                                                [
                                                                    'title' => Yii::t('yii', 'добавить 5 items'),
                                                                    'data-method'=>'post'
                                                                ]); ?>
                                                        </div>
                                                        <div class="col-sm-8">
                                                            <?php $form = ActiveForm::begin([
                                                                'method' => 'post',
                                                                'action' => ['/article-section-block-item/upload'],
                                                                'options' => ['enctype' => 'multipart/form-data'],
                                                            ]); ?>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <?= $form->field($uploadmodel, 'toModelProperty')->hiddenInput([
                                                                        'value'=>'image',
                                                                    ])->label(false) ?>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <?= $form->field($uploadmodel, 'imageFile')->fileInput(['class'=>'fileField'])->label(false) ?>
                                                                    <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$item->id])->label(false) ?>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <?= Html::submitButton('Image Upload', ['class' => 'btn btn-success btn-xs']) ?>
                                                                </div>
                                                            </div>
                                                            <?php ActiveForm::end() ?>
                                                        </div>
                                                    </div>

                                                    <?= $item->header?'<li> Header - '.$item->header.'</li>':'' ?>
                                                    <?= $item->header_class?'<li> Header - '.$item->header_class.'</li>':'' ?>
                                                    <?= $item->sort?'<li> Sort - '.$item->sort.'</li>':'' ?>
                                                    <?= $item->description?'<li> Description - '.$item->description.'</li>':'' ?>
                                                    <?= $item->text?'<li> Text - '.\common\models\Article::excerpt($item->text,100).'</li>':'' ?>
                                                    <?= $item->comment?'<li> Comment - '.\common\models\Article::excerpt($item->comment,100).'</li>':'' ?>
                                                    <?php
                                                    if ($item->image) {
                                                        if (substr(trim($item->image),0,4)=='<svg') {
                                                            $itemImageLi = '<li class="viewImageSvg"> Image <sup>svg</sup> - '.$item->image.'</li>';
                                                        } else {
                                                            $itemImageLi = '<li> Image - '
                                                                .Html::img('/img/view/'
                                                                    . Imagefiles::TERM_CUT_OVERFLOW
                                                                    . Imagefiles::SIZE_50_50
                                                                    . $item->image,
                                                                    ['class' => 'gridThumb'])
                                                                .'<sup>'.$item->image.'</sup>'
                                                                .Html::a( '<span class="glyphicon glyphicon-trash"></span>',
                                                                    '/article-section-block-item/delete-image?id='.$item->id.'&propertyName=image',
                                                                    [
                                                                        'title' => Yii::t('yii', 'Удалить image'),
                                                                        'data-confirm' =>'Точно удалить?',
                                                                        'data-method'=>'post'
                                                                    ])
                                                                .'</li>';
                                                        }
                                                    }
                                                    ?>
                                                    <?= $item->image?$itemImageLi:'' ?>
                                                    <?= $item->image_alt?'<li class="text-success"> Image Alt - '.$item->image_alt.'</li>':'' ?>
                                                    <?= $item->image_title?'<li class="text-warning"> Image Title - '.$item->image_title.'</li>':'' ?>
                                                    <?= $item->link_name?'<li> Link Name - '.$item->link_name.'</li>':'' ?>
                                                    <?= $item->link_url?'<li> Link Url - '.$item->link_url.'</li>':'' ?>
                                                    <?= $item->link_class?'<li> Link Class - '.$item->link_class.'</li>':'' ?>
                                                    <?= $item->link_description?'<li> Link Description - '.$item->link_description.'</li>':'' ?>
                                                    <?= $item->link_comment?'<li> Link Comment - '.$item->link_comment.'</li>':'' ?>
                                                    <?= $item->view?'<li> View - '.$item->view.'</li>':'' ?>
                                                    <?= $item->color_key?'<li> Color Key - '.$item->color_key.'</li>':'' ?>
                                                    <?= $item->structure?'<li> Structure - '.$item->structure.'</li>':'' ?>
                                                    <?= $item->custom_class?'<li> Custom Class - '.$item->custom_class.'</li>':'' ?>
                                                    <?= $item->accent?'<li> Accent - '.$item->accent.'</li>':'' ?>
                                                    <?= $item->type?'<li> Type - '.$item->type.'</li>':'' ?>
                                                </ul>
                                                <?php $itemNum++; endforeach; ?>
                                        </li>
                                    <?php endif; ?>
                                    <?= $block->conclusion?'<li> Conclusion - '.\common\models\Article::excerpt($block->conclusion,100).'</li>':'' ?>
                                    <?= $block->conclusion_class?'<li> Conclusion Class - '.$block->conclusion_class.'</li>':'' ?>
                                </ul>
                                <?php $blockNum++; endforeach; ?>
                        </li>
                    <?php endif; ?>

                    <?= $section->conclusion?'<li> Conclusion - '.\common\models\Article::excerpt($section->conclusion,100).'</li>':'' ?>
                    <?= $section->conclusion_class?'<li> Conclusion Class - '.$section->conclusion_class.'</li>':'' ?>
                </ul>

                <?php $sectionNum++; endforeach; ?>
        <?php endif; ?>

    </section>




<section class="mt50">
    <ol class="breadcrumb">
        <li>Article Preview <?php if ($model->view) {echo ' | view => '.$model->view;} ?></li>
    </ol>
</section>

<?php if ($model->view) : ?>
    <?= $this->render('/article/part_views/article/'.$model->view, [
        'article' => $model,
    ]) ?>
<?php endif; ?>

<?php if (!$model->view) : // если вюхи нет  ?>
    <?php $article = $model; ?>
    <h1 class="text-center"><?= Html::encode($article->pagehead) ?></h1>

    <?php if ($article->excerpt) : ?>
        <p><?= $article->excerpt ?></p>
    <?php endif; ?>
    <?php if ($article->excerpt_big) : ?>
        <p><?= $article->excerpt_big ?></p>
    <?php endif; ?>
    <?php if ($article->text) : ?>
        <p><?= nl2br($article->text)  ?></p>
    <?php endif; ?>

    <?php if ($article->sections) : ?>
        <?php foreach ($article->sections as $section) : ?>
            <?php if ($section->view) : ?>
                <?= $this->render('/article/part_views/section/'.$section->view, [
                    'model' => $section,
                ]) ?>
            <?php endif; ?>

            <?php if (!$section->view) : ?>
                <?= $this->render('/article/part_views/section/_as-default', [
                    'model' => $section,
                ]) ?>
            <?php endif; ?>

        <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>