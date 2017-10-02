<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'list_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'list_num')->textInput() ?>

    <?= $form->field($model, 'hrurl')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'keywords')->textarea(['rows' => 1]) ?>

    <?= $form->field($model, 'excerpt')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'excerpt_big')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pagehead')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topimage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'topimage_alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promolink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'promoname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagelink')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imagelink_alt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'link2original')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'view')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'layout')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'master_id')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        'unread'=>'Непроверено',
        'in_process'=>'В работе',
        'publish'=>'Опупликовано',
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
