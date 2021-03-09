<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ContextAdSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="context-ad-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'host') ?>

    <?= $form->field($model, 'master_id') ?>

    <?= $form->field($model, 'id_on_host') ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'daily_limit') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
