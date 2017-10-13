<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-5">
            <?= $form->field($model, 'list_name')->textarea(['rows'=>1,'maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'list_num')->textInput() ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'hrurl')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'pagehead')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'text')->textarea(['rows' => 8]) ?>
            <?= $form->field($model, 'link2original')->hiddenInput(['value' => 'masterpage'])->label(false) ?>
        </div>

        <div class="col-sm-6">
            <?= $form->field($model, 'author')->textInput(['maxlength' => true])->label('Автор, если текст чужой') ?>
            <?= $form->field($model, 'master_id')->hiddenInput(['value' => Yii::$app->request->get('master_id')])->label(false) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->dropDownList(['in_process' => 'в работе','publish'=>'опубликовано']) ?>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>


    </div>

    <?php ActiveForm::end(); ?>

</div>
