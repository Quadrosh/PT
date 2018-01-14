<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LtTgBotSession */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lt-tg-bot-session-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tg_user_id')->textInput() ?>

    <?= $form->field($model, 'item_id')->textInput() ?>

    <?= $form->field($model, 'item_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_response')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'remind_date')->textInput() ?>

    <?= $form->field($model, 'remind_text')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
