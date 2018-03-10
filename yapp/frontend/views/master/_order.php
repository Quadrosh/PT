<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;

/*
 * @var $master common\models\Master
 * @var $feedback common\models\Feedback
 */

?>

<p class="address">Прием осуществляется по адресу:<br>  <?= nl2br($master['address']) ?> </p>
<div class="sessionTypes">
    <?php if (isset($master->sessionAssighs)) : ?>
        <?php $count = 1?>
        <p class="sessionsInfo">Стоимость:
            <?php foreach ($master->sessionAssighs as $session) {
                if ($count != count($master->sessionAssighs)) {
                    echo '<span class="';
//                        echo $count==1 ?' capital':' lowercase';
                    echo ' lowercase';
                    echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                    echo count($master->sessionAssighs)>1 ? ', ':'';
                } else {
                    echo '<span class="';
//                        echo $count==1 ?' capital':' lowercase';
                    echo ' lowercase';
                    echo '">'.$session->sessionType['name'].'</span> - '.$session['value'].$session['comment'];
                }
                $count++;
            } ?>
        </p>
    <?php endif; ?>
</div>
<p>Записаться на сессию можно потелефону <?= $master['phone'] ?> </p>
<p>Или отправив заявку в форме </p>
<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <?php $form = ActiveForm::begin([
            'action' =>['/send/feedback'],
            'id' => 'quickorder-form-top',
            'method' => 'post',]); ?>
        <div class="row">
            <?= Html::errorSummary($feedback, ['class' => 'errors']) ?>

            <?php $session = Yii::$app->session;?>

            <?= $form->field($feedback, 'utm_source')
                ->hiddenInput(['value'=> $session['utmSource'], 'id' => 'quickorder_form_top-utm_source'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_medium')
                ->hiddenInput(['value'=>$session['utmMedium'], 'id' => 'quickorder_form_top-utm_medium'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_campaign')
                ->hiddenInput(['value'=>$session['utmCampaign'], 'id' => 'quickorder_form_top-utm_campaign'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_term')
                ->hiddenInput(['value'=>$session['utmTerm'], 'id' => 'quickorder_form_top-utm_term'])
                ->label(false) ?>
            <?= $form->field($feedback, 'utm_content')
                ->hiddenInput(['value'=>$session['utmContent'], 'id' => 'quickorder_form_top-utm_content'])
                ->label(false) ?>


            <?= $form->field($feedback, 'master_id')
                ->hiddenInput(['value'=>$master['id'],'id' => 'quickorder-form-top-from_page'])
                ->label(false) ?>

<!--                тип консультации -->
            <div class="col-sm-12">
                <div class="styled_select">
                    <?= $form->field($feedback, 'session_type')
                        ->dropDownList(\yii\helpers\ArrayHelper::map(
                            $master->sessionTypes, 'name','name'),[
                            'id'=>'quickorder-form-top-session',
                            'prompt'=>'Тип сессии'
                        ])
                        ->label(false) ?>
                </div>
            </div>
            <div class="col-sm-6">
                <?= $form->field($feedback, 'phone', [
                    'inputOptions' => [
                        'placeholder' => 'Номер телефона'
                    ]])
                    ->textInput(['maxlength' => true, 'id' => 'quickorder-form-top-phone'])
                    ->label(false) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($feedback, 'name', [
                    'inputOptions' => [
                        'placeholder' => 'Имя'
                    ]])
                    ->textInput(['maxlength' => true, 'id' => 'quickorder-form-top-name'])
                    ->label(false) ?>
            </div>
            <div class="col-sm-12">
                <?= $form->field($feedback, 'text', [
                    'inputOptions' => [
                        'placeholder' => 'Комментарий'
                    ]])
                    ->textInput(['maxlength' => true, 'id' => 'quickorder-form-top-text'])
                    ->label(false) ?>
            </div>

            <div class="col-sm-12  text-center">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-default']) ?>
            </div>
        </div>
        <?php $form = ActiveForm::end(); ?>
    </div>
</div>
