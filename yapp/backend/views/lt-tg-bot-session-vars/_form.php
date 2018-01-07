<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\LtTgBotSessionVars */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lt-tg-bot-session-vars-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lo_bot_session_id')->textInput() ?>

    <?= $form->field($model, 'step_number')->textInput() ?>

    <?= $form->field($model, 'step_text')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_response')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
