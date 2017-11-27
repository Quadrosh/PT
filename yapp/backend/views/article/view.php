<?php

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'list_name',
            'list_num',
//            'hrurl:url',
            [
                'attribute'=>'hrurl',
                'value' => function($model)
                {
                    if (Yii::$app->request->getHostName() == 'cp.psihotera.dev') {
                        $theData = '<a  href="http://psihotera.dev/article/'.$model['hrurl'].'">'.$model['hrurl'].'</a>';
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
//            'text:html',
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
            'promolink',
            'promoname',
            'imagelink',
            'imagelink_alt',
            'link2original',
            'author',
            'layout',
            'view',
            'master_id',
            'status',
        ],
    ]) ?>

</div>


<section>

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
                'unread'=>'Непроверено',
                'in_process'=>'В работе',
                'publish'=>'Опубликовано',
            ]) ?>
            <?php yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>
    <!--   / статус состояния -->


    <!--    Назначение картинки -->
    <div class="row mt20 bt pt20">
        <div class="col-xs-12 text-center">
            <h4>article image</h4>
       <?= cl_image_tag($model->topimagefile['cloudname'], [
                "alt" => $model['topimage_alt'],
//                            "width" => 70,
                "height" => 400,
                "crop" => "fill"
            ]); ?>
            <?php if ($model->topimagefile!=null) {
                echo  Html::a('Delete','/imagefiles/delete?id='.$model->topimagefile['id'], [
                    'class' => 'btn btn-danger rot90',
                    'title' => Yii::t('yii', 'Удалить'),
                    'data-pjax' => '0','data-method'=>'post'
                ]);
            } ?>
        </div>

        <div class="col-xs-12 col-sm-3 ">
            <h4>Image Cloud</h4>
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/cloud'],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>
            <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                'topimage'=>'Top Image',
            ])->label(false) ?>
            <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>
            <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$model->id])->label(false) ?>


            <?= Html::submitButton('<i class="fa fa-cloud-upload" aria-hidden="true"></i> Cloud', ['class' => 'btn btn-primary']) ?>
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

</section>