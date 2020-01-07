<?php

use common\models\Imagefiles;
use yii\helpers\Html;
use yii\grid\GridView;
use \yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Image files';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imagefiles-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Create Image file', ['create'], ['class' => 'btn btn-success']) ?>
<!--                --><?//= Html::a('Cloud', ['/imagefiles/cloud', 'file'=>'m2.jpg'], ['class' => 'btn btn-success']) ?>

    </p>

<!--    --><?php //echo cl_image_tag("rsh5hqbgeer3romquz8q", [
//        "alt" => "Sample Image" ,
//        "width" => 100,
//        "height" => 150,
////        "gravity" => "south_east",
//        "gravity" => "face",
////        "crop" => "thumb",
//        "crop" => "fill"
//    ]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=> 'Image',
                'value' => function($data){
                    return Html::img('/img/view/' . '0x100_' . $data->name, ['class' => 'img','style'=>'height:50px;']) ;
                },
                'format'=> 'html',
            ],
            'name',
//            'cloudname',
            [
                'attribute'=> 'cloudname',
                'value' => function($data){
                    if ($data->cloudname) {
                        return $data->cloudname .' '. Html::a('<i class="glyphicon glyphicon-arrow-down"></i>','/imagefiles/download-from-cloud?id='.$data->id);
                    }

                },
                'format'=> 'html',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
<section>
    <div class="container">

        <div class="row">
            <div class="col-xs-6 col-sm-3">
                <h4>Image Upload</h4>
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/imagefiles/upload'],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>

                <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>

                <?= Html::submitButton('Upload', ['class' => 'btn btn-success']) ?>
                <?php ActiveForm::end() ?>
            </div>
            <div class="col-xs-6 col-sm-3">
                <h4>Image Cloud</h4>
                <?php $form = ActiveForm::begin([
                    'method' => 'post',
                    'action' => ['/imagefiles/cloud'],
                    'options' => ['enctype' => 'multipart/form-data'],
                ]); ?>

                <?= $form->field($uploadmodel, 'imageFile')->fileInput()->label(false) ?>

                <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                <?php ActiveForm::end() ?>
            </div>

        </div>
    </div>

</section>
