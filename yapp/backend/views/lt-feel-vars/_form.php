<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LtFeelVars */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lt-feel-vars-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-sm-2"><?= $form->field($model, 'feel_id')->textInput() ?></div>
        <div class="col-sm-2"><?= $form->field($model, 'sort')->textInput() ?></div>
    </div>




    <?= $form->field($model, 'question')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'example')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
