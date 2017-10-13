<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use \yii\widgets\ActiveForm;

$uploadmodel = new \common\models\UploadForm();

/* @var $this yii\web\View */
/* @var $model common\models\Quote */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quotes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quote-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'list_num',
            'text:ntext',
            'addition:ntext',
            'image',
            'image_alt',
            'author',
            'master_id',
            'status',
        ],
    ]) ?>

</div>
<section>
    <div class="container">
        <!-- image cloud -->
        <div class="row mt20 bt pt20">
            <div class="col-xs-12 text-center">
                <h4>Quote image</h4>
                <?= cl_image_tag($model->imagefile['cloudname'], [
                    "alt" => $model['image_alt'],
                    "width" => 200,
                    "height" => 200,
                    "crop" => "fit",
//                    "crop" => "thumb",
//                    "gravity" => "face"
                ]); ?>
            </div>

            <div class="col-xs-12 col-sm-3 ">
                <h4>Image Cloud</h4>
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/quote/cloud'],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>
                <?= $form->field($uploadmodel, 'toModelProperty')->dropDownList([
                    'image'=>'Image',
                ])->label(false) ?>
                <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>
                <?= $form->field($uploadmodel, 'toModelId')->hiddenInput(['value'=>$model->id])->label(false) ?>


                <?= Html::submitButton('Cloud', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end() ?>
            </div>

        </div>
        <!-- /image cloud -->
    </div>
</section>