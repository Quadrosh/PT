<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Masterpageitem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="masterpageitem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'master_id')->textInput(['value' => Yii::$app->request->get('masterid')]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'link')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'link')
        ->dropDownList(
            \yii\helpers\ArrayHelper::map(\common\models\Article::find()->where(['master_id'=>Yii::$app->request->get('masterid')])->all(), 'hrurl','list_name')
        ); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
