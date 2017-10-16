<?php
use yii\widgets\ListView;
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>

<div class="row topFilter">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <?= Html::beginForm(['/master', 'id' => 'asdfa'], 'post', ['enctype' => 'multipart/form-data']); $model = new \common\models\Master();  ?>
                <!--            --><?php //$form = ActiveForm::begin([
                //                'id'=>'psyAssign',
                //                'action' => ['/master'],
                //                'method' => 'post',
                //            ]); $model = new \common\models\Master(); ?>

                <!--            --><?//= $form->field($model, 'name')->textInput() ?>
                <?= Html::input('text', 'name', '', ['class' => 'someclass']) ?>



                <!--            --><?php //ActiveForm::end(); ?>

            </div>
            <div class="col-sm-3">
                <?= Html::submitButton('Поиск', ['class' => 'btn btn-default btn-xs']) ?>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
            <?= Html::endForm() ?>
        </div>
    </div>


</div>
<div class="container">
    <div class="site-index">
        <div class="row">
            <div class="col-sm-12 ">
                <h2 class="indexHead">Психотерапевты</h2>
            </div>


            <div class="col-sm-12">
                <?php echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_master_list_item',
                ]);?>
            </div>





            <div class="col-sm-12">
<!--                --><?php //echo \yii\grid\GridView::widget([
//                    'dataProvider' => $searchDataProvider,
//                    'columns'=>[
//                        'username',
//                        'name',
//                        'surname',
//                        [
//                            'attribute'=>'pros',
//                            'value'=>'pros.name'
//                        ],
//                        [
//                            'attribute'=>'psys',
//                            'value'=>'psys.name'
//                        ],
//                    ]
//                ]);?>
            </div>


        </div>
    </div>
</div>

