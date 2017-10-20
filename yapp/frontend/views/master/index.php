<?php
use yii\widgets\ListView;
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>

<div class="row topFilter">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">

                <?php $form = ActiveForm::begin([
                                'id'=>'filterForm',
                                'action' => ['/master'],
                                'method' => 'post',
                            ]); $filterForm = new \common\models\FilterForm(); ?>

                <?= $form->field($filterForm, 'city')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\CityItem::find()->orderBy('name')->all(), 'id','name'),[
                        'id'=>'city_assign-item_id',
                        'class'=>'selectpicker',
                        'value'=>$current['city'],
                    ])
                    ->label(false) ?>


            </div>
            <div class="col-sm-3">
                <?= Html::submitButton('<i class="fa fa-refresh" aria-hidden="true"></i>', ['class' => 'btn btn-default ']) ?>
            </div>
            <div class="col-sm-3"></div>
            <div class="col-sm-3"></div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>


</div>
<div class="container">
    <div class="site-index">
        <div class="row">
            <div class="col-sm-12 ">
                <h2 class="indexHead">Психотерапевты</h2>
                <p> <?= $current['headLine'] ?></p>
            </div>


            <div class="col-sm-12">
                <?php echo ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_master_list_item',
                ]);?>
            </div>





<!--            <div class="col-sm-12">-->
<!--                --><?php //echo \yii\grid\GridView::widget([
//                    'dataProvider' => $searchDataProvider,
//                    'columns'=>[
//                        'username',
//                        'name',
//                        'surname',
//                        'fio',
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
<!--            </div>-->


        </div>
    </div>
</div>

