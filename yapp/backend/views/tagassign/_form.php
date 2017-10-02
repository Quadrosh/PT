<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Tagassign */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tagassign-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tag_id')->textInput() ?>

    <?= $form->field($model, 'article_id')->textInput() ?>

    <?= $form->field($model, 'master_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
