<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use \common\models\Article;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$article = Article::find()->where(['id'=>Yii::$app->request->get('id')])->one();
$master = $article->master;
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['/master/index']];
$this->params['breadcrumbs'][] = ['label' => $master['username'], 'url' => ['/master/view?id='.$master['id']]];
$this->params['breadcrumbs'][] = ['label' => 'Тексты мастера', 'url' => ['master-texts?master_id='.$master['id']]];
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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'list_name',
            'list_num',
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
//            'title',
//            'description:ntext',
//            'keywords:ntext',
            'pagehead',
            'text:html',
//            'excerpt',
//            'excerpt_big',
//            'topimage',
//            'topimage_alt',
//            'promolink',
//            'promoname',
//            'imagelink',
//            'imagelink_alt',
            'link2original',
            'author',
//            'layout',
//            'view',
            'master_id',
            'status',
        ],
    ]) ?>

</div>
<section>
    <div class="row mt50 bt pt50">
        <h6 class="text-center"><span class="grey">Текущий значение hrurl:</span><br><?= $model['hrurl'] ? $model['hrurl']:'<span class="label label-warning">не заполнено</span>'; ?></h6>
        <div class="col-xs-9">
            <?php $form = ActiveForm::begin([
                'method' => 'post',
                'action' => ['/article/update?id='.$model['id']],
                'options' => ['enctype' => 'multipart/form-data'],
            ]); ?>
            <?= $form->field($model, 'hrurl')
                ->textInput(['value'=>Article::cyrillicToLatin($model['list_name'], 210, true)])
                ->label(false) ?>
        </div>
        <div class="col-xs-3 text-right">
            <?= Html::submitButton('назначить hrurl', ['class' => 'btn btn-primary']) ?>
        </div>
            <?php ActiveForm::end() ?>
    </div>


    <div class="row mt50 bt pt50">
        <div class="col-xs-6 col-xs-offset-3 ">
            <h4>Статус</h4>
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
                    '<button type="submit" class="btn rRound btn-primary">Назначить</button></span></div>',
            ])->dropDownList([
                'unread'=>'Непроверено',
                'in_process'=>'В работе',
                'publish'=>'Опупликовано',
            ]) ?>
            <?php yii\bootstrap\ActiveForm::end() ?>
        </div>
    </div>



</section>