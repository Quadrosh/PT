<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$master = \common\models\Master::find()->where(['hrurl'=>Yii::$app->request->get('hrurl')])->one();
$feedback = new \common\models\Feedback;
?>
<?php Pjax::begin([
    'id' => 'masterArticleText',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>

    <i>Прием осуществляется по адресу:<br>  <?= nl2br($master['address']) ?> </i>
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

                <div class="col-sm-12  text-center">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-default']) ?>
                </div>
            </div>
            <?php $form = ActiveForm::end(); ?>
        </div>
    </div>



<?php Pjax::end(); ?>