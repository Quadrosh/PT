<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-section-block-item-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'article_section_block_id') ?>

    <?= $form->field($model, 'sort') ?>

    <?= $form->field($model, 'header') ?>

    <?= $form->field($model, 'header_class') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'text') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'image') ?>

    <?php // echo $form->field($model, 'image_alt') ?>

    <?php // echo $form->field($model, 'link_description') ?>

    <?php // echo $form->field($model, 'link_name') ?>

    <?php // echo $form->field($model, 'link_url') ?>

    <?php // echo $form->field($model, 'link_class') ?>

    <?php // echo $form->field($model, 'link_comment') ?>

    <?php // echo $form->field($model, 'view') ?>

    <?php // echo $form->field($model, 'color_key') ?>

    <?php // echo $form->field($model, 'structure') ?>

    <?php // echo $form->field($model, 'accent') ?>

    <?php // echo $form->field($model, 'custom_class') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
