<?php

use dosamigos\datepicker\DatePicker;
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */





$structure = $model->structure;
$s = Yii::$app->session;



$houseId = '';
$roomId = '';
if ($structure) {
    foreach (explode('&', $structure) as $chunk) {
        $param = explode("=", $chunk);

        if ($param[0]=='house' || $param[0]=='houseId'|| $param[0]=='house_id') {
            $houseId=$param[1];
        }
    }
} else {
    if (isset($s['houseId'])) {
        $houseId = $s['houseId'];
    } else {
        $houseId = 1;
    }
}

$house = \common\models\House::findOne($houseId);
$houseName = $house->name;




$formModel = new \common\models\CalcPriceOnHouseForm();

$formModel['dateFrom'] = isset($s['dateFrom'])?$s['dateFrom']:null;
$formModel['dateTo'] = isset($s['dateTo'])?$s['dateTo']:null;
$persons = isset($s['persons'])?$s['persons']:null;
if (isset($s['persons'])) {
    $persons = $s['persons'];
} else {
    if (isset($s['roomBook']) && $s['roomBook'][0] && isset($s['roomBook'][0]['persons'])) {
        $persons = $s['roomBook'][0]['persons'];
    } else {
        $persons = 2;
    }
}
if (isset($s['children'])) {
    $children = $s['children'];
} else {
    if (isset($s['roomBook']) && $s['roomBook'][0] && isset($s['roomBook'][0]['children'])) {
        $children = $s['roomBook'][0]['children'];
    } else {
        $children = null;
    }
}

if (isset($s['roomBook']) && $s['roomBook'][0] && isset($s['roomBook'][0]['additional_bed'])) {
    $addBed= $s['roomBook'][0]['additional_bed'];
} else {
    $addBed = null;
}



?>
<div class="asb-order_form_on_house">


    <?php if (!$model->header) : ?>
        <h3 class="text-center"> РАСЧЕТ ЦЕНЫ </h3>
    <?php endif; ?>
    <?php if ($model->header) : ?>
        <h3 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h3>
    <?php endif; ?>

    <?php if ($model->description) : ?>
        <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= $model->description ?></p>
    <?php endif; ?>




    <div class="orderFormOnHouse">

        <div class="check_rates_box ">
            <?php $form = ActiveForm::begin([
                'id'=>'calcPriceFormOnHouse',
                'action' => ['/booking/calculate-price-on-house'],
                'method' => 'post',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-3',
                        'offset' => 'col-sm-offset-3',
                        'wrapper' => 'col-sm-9',
                        'error' => 'col-sm-9',
                        'hint' => '',
                    ],
                ],

            ]); ?>

            <div class="row">
                <div class="col-sm-4 formSelect">
                    <?= $form->field($formModel, 'roomId',[
                            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                            'horizontalCssClasses' => [
                                'label' => false,
                                'offset' => false,
                                'wrapper' => 'col-sm-12 roomSelect',
                                'error' => '',
                                'hint' => '',
                            ]
                    ])
                        ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Apartment::find()
                            ->where(['house_id'=>$houseId])
                            ->all(),'id','name'
                        ),['prompt'=>'Выбрать номер','value'=>$roomId])
                        ->label(false) ?>
                </div>


                <div class="col-sm-4 formSelect">
                    <?= $form->field($formModel , 'dateFrom',[
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-2 ',
                            'offset' => 'col-sm-offset-2',
                            'wrapper' => 'col-sm-10 ',
                            'error' => '',
                            'hint' => '',
                        ]
                    ])->widget(DatePicker::class,
                        [
                            'language' => 'ru',
                            'size' => 'md',
                            'clientOptions' => [
                                'autoclose' => true,
                                'todayHighlight' => true,
                                'format' => 'dd-mm-yyyy'
                            ],
                            'options'=>[
                                'id'=>'bottomOrderFormFrom',
                            ]
                        ]
                    )->label('с'); ?>
                </div>
                <div class="col-sm-4 formSelect">
                    <?= $form->field($formModel, 'dateTo',[
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-2 ',
                            'offset' => 'col-sm-offset-2',
                            'wrapper' => 'col-sm-10 ',
                            'error' => '',
                            'hint' => '',
                        ]
                    ])->widget(DatePicker::class,
                        [
                            'language' => 'ru',
                            'size' => 'md',
                            'clientOptions' => [
                                'autoclose' => true,
                                'todayHighlight' => true,
                                'format' => 'dd-mm-yyyy'
                            ],
                            'options'=>[
                                'id'=>'bottomOrderFormTo',
                            ]
                        ]
                    )->label('по'); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 formSelect">
                    <?= $form->field($formModel, 'persons',[ 'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-2 ',
                            'offset' => 'col-sm-offset-2',
                            'wrapper' => 'col-sm-10 personSelect',
                            'error' => '',
                            'hint' => '',
                        ]])
                        ->dropDownList([
                            '1'=>'1 взрослых',
                            '2'=>'2 взрослых',
                            '3'=>'3 взрослых',
                            '4'=>'4 взрослых',
                            '5'=>'5 взрослых',
                        ],['value'=>$persons?$persons:'2'])
                        ->label('для') ?>
                </div>

                <div class="col-sm-4 formSelect">
                    <?= $form->field($formModel, 'children',[ 'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-2 ',
                            'offset' => 'col-sm-offset-2',
                            'wrapper' => 'col-sm-10 personSelect',
                            'error' => '',
                            'hint' => '',
                        ]])
                        ->dropDownList([
                            '1'=>'1 ребенок',
                            '2'=>'2 ребенка',
                            '3'=>'3 ребенка',
                            '4'=>'4 ребенка',

                        ],['prompt'=>'','value'=>$children?$children:false])
                        ->label('дети') ?>
                </div>

                <div class="col-sm-4 formSelect">
                    <?= $form->field($formModel, 'eatPersons',[ 'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                        'horizontalCssClasses' => [
                            'label' => 'col-sm-3 ',
                            'offset' => 'col-sm-offset-3',
                            'wrapper' => 'col-sm-9 personSelect',
                            'error' => '',
                            'hint' => '',
                        ]])
                        ->dropDownList([
                            '1'=>'1 персоны',
                            '2'=>'2 персоны',
                            '3'=>'3 персоны',
                            '4'=>'4 персоны',

                        ],['prompt'=>'без питания','value'=>$children?$children:false])
                        ->label('Питание') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-1 text-center formSelect">

                    <?= $form->field($formModel, 'addBed')
                        ->checkbox(['uncheck' => false, 'checked' => true])
                        ->label('Дополнительная кровать') ?>

                </div>
            </div>
            <div class="row">

                <div class="col-sm-12 text-center  mt30">
                    <?= $form->field($formModel, 'houseId')
                        ->hiddenInput(['value'=>$houseId])->label(false) ?>

                        <?= Html::submitButton('Пересчитать цену', ['class' => 'btn btn-success','id'=>'submitOfHouseCalcPrice']) ?>

                </div>
            </div>



            <?php ActiveForm::end(); ?>
        </div>


        <div class="row">
            <div id="priceItem" class="hidden bigBox bordered text-center col-sm-8 col-sm-offset-2">
                <div class="col-sm-6 ">
                    Цена <span id="dailyPriceItem"></span>р. в день.
                </div>
                <div class="col-sm-6">
                    Сумма <span id="fullPriceItem"></span>р.
                </div>
            </div>

            <div class="col-sm-8 col-sm-offset-2 text-center">
                <span class="hidden bigBox bordered" id="priceErrorItem"></span>
            </div>
        </div>




        <div id="houseOrderContactForm"  class="col-sm-12 box text-center hidden" >
            <div class="contact_form_box">
                <?php
                $model = new \common\models\CartContactForm;

                $form = ActiveForm::begin([
                    'id'=>'contactForm',
                    'action' => ['/booking/order?fromPage=house'],
                ]);
                ?>

                <div class="row">
                    <div class="col-sm-6 ">
                        <?= $form->field($model, 'firstName')->textInput(['placeholder'=>'Имя'])->label(false) ?>
                    </div>

                    <div class="col-sm-6 ">
                        <?= $form->field($model, 'lastName')->textInput(['placeholder'=>'Фамилия'])->label(false) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 ">
                        <?= $form->field($model, 'phone')->textInput(['placeholder'=>'Телефон'])->label(false) ?>
                    </div>
                    <div class="col-sm-6 ">
                        <?= $form->field($model, 'email')->textInput(['placeholder'=>'email'])->label(false) ?>
                    </div>
                    <div class="col-sm-12 ">
                        <?= $form->field($model, 'text')->textInput(['placeholder'=>'Комментарий'])->label(false) ?>
                    </div>
                </div>

                <div class="col-sm-4 col-sm-offset-4 mt50">
                    <div class="goNext">
                        <?= Html::submitButton('<span></span><strong>Забронировать</strong><span></span>', ['class' => 'btn btn-success']) ?>
                    </div>

                </div>


                <?php ActiveForm::end(); ?>
            </div>

        </div>





    </div>





</div>

