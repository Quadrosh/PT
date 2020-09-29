<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\ArticleSectionBlockItem;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-section-block-item-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-sm-2">
            <?= $form->field($model, 'article_section_block_id')->textInput(['readonly'=>$model->article_section_block_id]) ?>
        </div>
        <div class="col-sm-5">
            <?php if ($model->article_section_block_id) {
                echo '<h4>'.$model->block->header.'</h4>';
            }?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'code_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-8">
            <?= $form->field($model, 'header')->textarea(['rows'=>1,'maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'header_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSectionBlockItem::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'description_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSectionBlockItem::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'text')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'text_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSectionBlockItem::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'comment')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'comment_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSectionBlockItem::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
        </div>



    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'image')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'image_class')->dropDownList([
                'float-right w50perSm' => 'float-right w50perSm',
                'float-left w50perSm' => 'float-left w50perSm',
                'w50perSm' => 'w50perSm',
                'w30perCenter' => 'w30perCenter',
                'w20per' => 'w20per',
                'w20perCenter' => 'w20perCenter',
                'w100' => 'w100',
                'w100Center' => 'w100Center',
                'w80' => 'w80',
                'w50' => 'w50',
            ],['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-7">
            <?= $form->field($model, 'image_alt')->textarea(['rows' => 1,'maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'image_title')->textarea(['rows' => 1]) ?>
        </div>
    </div>
    <div class="row">


        <div class="col-sm-4">
            <?= $form->field($model, 'link_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'link_url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'link_class')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'link_description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'link_comment')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-3">
            <?= $form->field($model, 'view')
                ->dropDownList(ArticleSectionBlockItem::VIEW_OPTIONS,['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'color_key')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSectionBlockItem::COLOR_KEY_OPTIONS),
                    ['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'structure')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'custom_class')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-1">
            <?= $form->field($model, 'accent')->checkbox() ?>
        </div>

        <div class="col-sm-4">
            <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-12">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>





    </div>
    <?php ActiveForm::end(); ?>

</div>
