<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

//$preorderForm = new \common\models\Preorders();

$feedback = new \common\models\Feedback;

?>


<div class="row">
    <div class="col-sm-8 col-sm-offset-2 pb100">
        <?php $form = ActiveForm::begin([
            'action' =>['/send/request-appointment'],
            'id' => 'quickorder-form-top',
            'method' => 'post',]); ?>
        <div class="row  pr10 pl10">
            <?= Html::errorSummary($feedback, ['class' => 'errors']) ?>

            <?php $session = Yii::$app->session;?>

            <?= $form->field($feedback, 'utm_source')
                ->hiddenInput(['value'=> $session['utm_source'], 'id' => 'quickorder_form_top-utm_source'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_medium')
                ->hiddenInput(['value'=>$session['utm_medium'], 'id' => 'quickorder_form_top-utm_medium'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_campaign')
                ->hiddenInput(['value'=>$session['utm_campaign'], 'id' => 'quickorder_form_top-utm_campaign'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_term')
                ->hiddenInput(['value'=>$session['utm_term'], 'id' => 'quickorder_form_top-utm_term'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_content')
                ->hiddenInput(['value'=>$session['utm_content'], 'id' => 'quickorder_form_top-utm_content'])
                ->label(false) ?>


            <?= $form->field($feedback, 'master_id')
                ->hiddenInput(['value'=>$master['id'],'id' => 'quickorder-form-top-from_page'])
                ->label(false) ?>

            <!--                тип консультации -->
            <div class="col-sm-6 col-sm-offset-3">
                <div class="styleSelect">
                    <?= $form->field($feedback, 'session_type')
                        ->dropDownList(\yii\helpers\ArrayHelper::map(
                            $master->sessionTypes, 'name','name'),[
                            'id'=>'quickorder-form-top-session',
                            'class'=>'form-control',
                            'prompt'=>'Тип сессии',
                        ])
                        ->label(false) ?>
                </div>
            </div>
            <div class="col-sm-6">
                <?= $form->field($feedback, 'phone')
                    ->textInput()->widget(\yii\widgets\MaskedInput::class, [
                    'mask' => '+9 999 999-99-99',
                    'options' => ['placeholder' => 'Телефон',  'class' => 'form-control transparent']
                ])->label(false); ?>



<!--                --><?//= $form->field($feedback, 'phone')
//                    ->textInput(['maxlength' => true, 'id' => 'quickorder-form-top-phone'])
//                    ->label(false) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($feedback, 'name')
                    ->textInput([
                            'placeholder' => "Имя",
                            'maxlength' => true,
                            'id' => 'quickorder-form-top-name',
                    ])
                    ->label(false) ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($feedback, 'text')
                    ->textInput([
                            'placeholder' => 'Комментарий',
                            'maxlength' => true,
                            'id' => 'quickorder-form-top-text'
                    ])
                    ->label(false) ?>
            </div>

            <div class="col-sm-12  text-center">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-default '.(isset($model) && isset($model['call2action_class'])?$model['call2action_class']:null)]) ?>
            </div>
        </div>
        <?php $form = ActiveForm::end(); ?>
    </div>
</div>





<!--<section id="mainOrderSection"-->
<!--         class="--><?//= $article->call2action_class?$article->call2action_class:'' ?><!--">-->
<!--   <div class="row">-->
<!---->
<!--       <div class="text-center">-->
<!--           --><?//= Html::a('Оформить заявку', '#orderForm',['class' => 'btn btn-primary order-btn mt10 mb20', 'data-toggle'=>'collapse']) ?>
<!--       </div>-->
<!---->
<!--       <div class="feedback-form panel-collapse collapse col-md-10 col-md-offset-1  col-lg-8 col-lg-offset-2 " id="orderForm">-->
<!--           --><?php //$form = ActiveForm::begin([
//               'action' =>['site/order'],
//               'id' => 'order-form',
//               'method' => 'post',]); ?>
<!---->
<!--           <div class="row">-->
<!--               <div class="col-sm-6">-->
<!--                   --><?//= $form->field($preorderForm, 'house_id')
//                       ->textInput(['required' => true,'id' => 'preorder_form-dispatch'])->label('Корпус') ?>
<!--               </div>-->
<!--               <div class="col-sm-6">-->
<!--                   --><?//= $form->field($preorderForm, 'apartment_id')
//                       ->textInput(['required' => true,'id' => 'preorder_form-destination'])->label('Номер') ?>
<!--               </div>-->
<!--           </div>-->
<!--           <div class="row">-->
<!---->
<!--               <div class="col-sm-6">-->
<!--                   --><?//= $form->field($preorderForm, 'phone')
//                       ->textInput(['required' => true,'id' => 'preorder_form-phone']) ?>
<!--               </div>-->
<!--               <div class="col-sm-6">-->
<!--                   --><?//= $form->field($preorderForm, 'email')
//                       ->textInput(['maxlength' => true,'id' => 'preorder_form-email']) ?>
<!--               </div>-->
<!--           </div>-->
<!--           <div class="row">-->
<!--               <div class="col-sm-6">-->
<!--                   --><?//= $form->field($preorderForm, 'date')
//                       ->textInput(['required' => true,'id' => 'preorder_date'])->label('Дата заселения')  ?>
<!--               </div>-->
<!--               <div class="col-sm-6">-->
<!--                   --><?//= $form->field($preorderForm, 'duration')
//                       ->textInput(['maxlength' => true,'id' => 'preorder_duration'])->label('Срок в днях')  ?>
<!--               </div>-->
<!--               <div class="col-sm-12">-->
<!--                   --><?//= $form->field($preorderForm, 'text')
//                       ->textarea(['rows' => 1,'id' => 'preorder_form-text'])->label('Комментарий') ?>
<!--               </div>-->
<!---->
<!--               --><?//= $form->field($preorderForm, 'from_page')
//                   ->hiddenInput(['value'=>$article->hrurl ,'id' => 'preorder_form-from_page'])->label(false) ?>
<!---->
<!--               --><?//= $form->field($preorderForm, 'utm_source')
//                   ->hiddenInput([ 'id' => 'preorder_form-utm_source'])->label(false) ?>
<!--               --><?//= $form->field($preorderForm, 'utm_medium')
//                   ->hiddenInput([ 'id' => 'preorder_form-utm_medium'])->label(false) ?>
<!--               --><?//= $form->field($preorderForm, 'utm_campaign')
//                   ->hiddenInput([ 'id' => 'preorder_form-utm_campaign'])->label(false) ?>
<!--               --><?//= $form->field($preorderForm, 'utm_term')
//                   ->hiddenInput([ 'id' => 'preorder_form-utm_term'])->label(false) ?>
<!--               --><?//= $form->field($preorderForm, 'utm_content')
//                   ->hiddenInput([ 'id' => 'preorder_form-utm_content'])->label(false) ?>
<!---->
<!--               <div class="col-sm-6 col-sm-offset-3 text-center">-->
<!--                   --><?//= Html::submitButton('Отправить', ['class' => 'btn btn-primary sendorder-btn mt10']) ?>
<!--               </div>-->
<!--           </div>-->
<!--           --><?php //$form = ActiveForm::end(); ?>
<!--       </div>-->
<!--   </div>-->
<!---->
<!---->
<!--</section>-->