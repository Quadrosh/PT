<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \common\models\ArticleSection;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSection */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-section-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'article_id')->textInput(['readonly'=>$model->article_id]) ?>
        </div>
        <div class="col-sm-5">
            <?php if ($model->article_id) {
                echo '<h4>'.$model->article->list_name.'</h4>';
            }?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'code_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'header')->textarea(['maxlength' => true, 'rows'=>1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'header_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSection::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-8">
            <?= $form->field($model, 'description')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'description_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSection::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
        </div>

        <div class="col-sm-8">
            <?= $form->field($model, 'raw_text')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-1">
            <?= Html::button('b', ['class' => 'btn btn-default',
                'id'=>'2bold_text',
                'onClick'=>"addTag('b','#articlesection-raw_text');"
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'raw_text_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSection::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
        </div>

        <div class="col-sm-8">
            <?= $form->field($model, 'conclusion')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'conclusion_class')
                ->dropDownList(Yii::$app->helpers->value2KeyValue(ArticleSection::TEXT_CLASS_OPTIONS),['prompt' => 'Выбери']) ?>
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
                'w50per' => 'w50per',
                'w30per' => 'w30per',
                'w30perCenter' => 'w30perCenter',
                'w20per' => 'w20per',
                'w15per' => 'w15per',
                'w10per' => 'w10per',
                'w8per' => 'w8per',
                'w5per' => 'w5per',
                'float-left w20per' => 'float-left w20per',
                'float-right w20per' => 'float-right w20per',
                'w100' => 'w100',
                'w80' => 'w80',
                'w50' => 'w50',
            ],['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-7">
            <?= $form->field($model, 'image_alt')->textarea(['rows' => 1,'maxlength' => true]) ?>
        </div>
        <div class="col-sm-12">
            <?= $form->field($model, 'image_title')->textarea(['rows' => 1,'maxlength' => true]) ?>
        </div>

        <div class="col-sm-2">
            <?= $form->field($model, 'background_image')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-10">
            <?= $form->field($model, 'background_image_title')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'thumbnail_image')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'thumbnail_image_alt')->textarea(['rows' => 1]) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'thumbnail_image_title')->textarea(['rows' => 1]) ?>
        </div>

    </div>
    <div class="row">


        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_link')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'call2action_class')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'call2action_description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'call2action_comment')->textInput(['maxlength' => true]) ?>
        </div>


        <div class="col-sm-3">
            <?= $form->field($model, 'view')->dropDownList(\common\models\ArticleSection::VIEW_OPTIONS,['prompt' => 'Выбери вьюху']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'color_key')
                ->dropDownList([
                    'bright' => 'bright',
                    'dark' => 'dark',
                    'grey' => 'grey',
                ],['prompt' => 'Выбери']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'structure')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'custom_class')->textInput(['maxlength' => true]) ?>
        </div>
    </div>




    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


<?php
$script = "

function addTag(tag, sharpedId) {
    var textArea = $(sharpedId);
    var start = textArea[0].selectionStart;
    var end = textArea[0].selectionEnd;
    if(textArea[0].selectionEnd - textArea[0].selectionStart != 0){
        var replacement = '<'+tag+' >' + textArea.val().substring(start, end) + '</'+tag+'>';
        textArea.val(textArea.val().substring(0, start) + replacement + textArea.val().substring(end, textArea.val().length));
    }
}

";
$this->registerJs($script, yii\web\View::POS_BEGIN);
?>