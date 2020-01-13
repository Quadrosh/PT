<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;

//$preorderForm = new \common\models\Preorders();


?>

futorder form
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