<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContextAd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="context-ad-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

        <div class="col-sm-3 col-sm-offset-3">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'daily_limit')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'master_id')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'host')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'id_on_host')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-12">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>

    </div>







    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
