<?php
use yii\widgets\ListView;
use \yii\helpers\Html;
use \yii\widgets\ActiveForm;
?>

<div class="row topFilter">
    <div class="container">
        <div class="row">
            <?php $form = ActiveForm::begin([
                'id'=>'filterForm',
                'action' => ['/master/filter'],
                'method' => 'post',
            ]); $filterForm = new \common\models\FilterForm(); ?>

            <div class="col-sm-2  text-center">
                <?= $form->field($filterForm, 'city')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(
                        \common\models\CityItem::find()->orderBy('name')->all(), 'id','name'),[
                        'id'=>'city_assign-item_id',
                        'class'=>'selectpicker',
                        'value'=>isset($current['city'])?$current['city']:'',
                        'prompt'=>'Город'
                    ])
                    ->label(false) ?>
            </div>
            <div class="col-sm-2 text-center">
                <?= $form->field($filterForm, 'tag')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tag::find()->orderBy('name')->all(), 'id','name'),[
                        'id'=>'tag_assign-item_id',
                        'class'=>'selectpicker',
//                        'class'=>'filterSelect',
                        'value'=>isset($current['tag'])?$current['tag']:'',
                        'prompt'=>'Метка'
//                        'prompt'=>[
//                            'label' => 'Метка',
//                            'text' => 'Метка текст',
//                            'class' => 'selectpicker_prompt',
//                            'value' => '-1'
//                        ]
                    ])
                    ->label(false) ?>
            </div>
            <div class="col-sm-2 text-center">
                <?= $form->field($filterForm, 'psy')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PsychotherapyItem::find()->orderBy('name')->all(), 'id','name'),[
                        'id'=>'psy_assign-item_id',
                        'class'=>'selectpicker',
                        'value'=>isset($current['psy'])?$current['psy']:'',
                        'prompt'=>'Психотерапия'
                    ])
                    ->label(false) ?>
            </div>
            <div class="col-sm-2 text-center">
                <?= $form->field($filterForm, 'pro')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ProfessionItem::find()->orderBy('name')->all(), 'id','name'),[
                        'id'=>'pro_assign-item_id',
                        'class'=>'selectpicker',
                        'value'=>isset($current['pro'])?$current['pro']:'',
                        'prompt'=>'Профессия'
                    ])
                    ->label(false) ?>
            </div>
            <div class="col-sm-2 text-center">
                <?= $form->field($filterForm, 'session')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SessionTypeItem::find()->orderBy('name')->all(), 'id','name'),[
                        'id'=>'session_assign-item_id',
                        'class'=>'selectpicker',
                        'value'=>isset($current['session'])?$current['session']:'',
                        'prompt'=>'Вид приема'
                    ])
                    ->label(false) ?>
            </div>
            <div class="col-sm-2 text-center">
                <?= Html::submitButton('<i class="fa fa-refresh" aria-hidden="true"></i>', ['class' => 'btn btn-default submit-btn ']) ?>
            </div>
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

