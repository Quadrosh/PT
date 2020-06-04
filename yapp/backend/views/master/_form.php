<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\Master;

/* @var $this yii\web\View */
/* @var $model common\models\Master */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="master-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">


        <div class="col-sm-4">
            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'hrurl')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'root')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'status')->dropDownList([
                'regular'=>'regular',
                'draft'=>'draft',
                'premium' => 'premium',
            ]) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'middlename')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'image')->textarea(['rows' => 1,'maxlength' => true]) ?>

        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'image_alt')->textarea(['rows' => 1,'maxlength' => true]) ?>

        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'address')->textarea(['rows' => 2,'maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'other_contacts')->textarea(['rows' => 2]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-12">
            <?= $form->field($model, 'list_add')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'hello')->textarea(['rows' => 1]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'view')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'order_view')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'layout')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'stylekey')->dropDownList(['dark' => 'Dark','bright'=>'Bright']) ?>
        </div>

    </div>

    <div class="row">

        <div class="col-sm-6">
            <?= $form->field($model, 'order_messenger')->dropDownList(
                [
                    'email'=>'email',
                    'telegram' => 'telegram'
                ]) ?>

        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'order_messenger_id')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'order_phone')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'order_sms_enable')->dropDownList([
                Master::ORDER_BY_SMS_ENABLE => Master::ORDER_BY_SMS_ENABLE,
                Master::ORDER_BY_SMS_DISABLE => Master::ORDER_BY_SMS_DISABLE,
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'order_sms_count')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($model, 'comment')->textarea(['rows' => 1]) ?>
        </div>
    </div>















<!--    --><?//= $form->field($model, 'site_link')->textInput(['maxlength' => true]) ?>
<!---->
<!--    --><?//= $form->field($model, 'site_id')->textInput() ?>




    <!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
