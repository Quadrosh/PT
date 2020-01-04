<?php

use common\models\Article;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'type')->dropDownList(Yii::$app->helpers->value2KeyValue([
                Article::TYPE_ARTICLE,
                Article::TYPE_MASTER_TEXT,
                Article::TYPE_PAGE,
            ]),['prompt' => 'Выбери']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'status')->dropDownList(Yii::$app->helpers->value2KeyValue([
                Article::STATUS_PUBLISHED,
                Article::STATUS_IN_PROCESS,
                Article::STATUS_UNREAD
            ]),['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'list_num')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'master_id')->textInput() ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'object_type')->dropDownList(Yii::$app->helpers->value2KeyValue([
                Article::OBJECT_TYPE_MASTER,
            ]),['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'object_id')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'list_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'hrurl')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'keywords')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'excerpt')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'excerpt_big')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'text')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'pagehead')->textarea(['maxlength' => true,'rows' => 1]) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'topimage')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-7">
            <?= $form->field($model, 'topimage_alt')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'topimage_title')->textarea(['maxlength' => true,'rows' => 1]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'background_image')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-10">
            <?= $form->field($model, 'background_image_title')->textarea(['rows' => 1]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'thumbnail_image')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'thumbnail_image_alt')->textarea(['rows' => 1,'maxlength' => true]) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'thumbnail_image_title')->textarea(['rows' => 1]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_class')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'call2action_description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'call2action_comment')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'imagelink')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'imagelink_alt')->textInput(['maxlength' => true]) ?>
        </div>
    </div>



    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'promoname')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'promolink')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'link2original')->textInput(['maxlength' => true]) ?>
        </div>

    </div>


    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'view')->dropDownList([

            ],['prompt' => 'Выбери ']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'layout')->dropDownList([

            ],['prompt' => 'Выбери']) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
