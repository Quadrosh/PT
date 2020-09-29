<?php

use yii\helpers\Html;
use \yii\widgets\ActiveForm;
use \common\models\Visit;

//$preorderForm = new \common\models\Preorders();

$feedback = new \common\models\Feedback;

?>



<?php $form = ActiveForm::begin([
    'action' =>['/send/request-appointment'],
    'id' => 'quickorder-form-top',
    'method' => 'post',]); ?>

    <?= Html::errorSummary($feedback, ['class' => 'errors']) ?>

    <?php $session = Yii::$app->session;?>

    <?= $form->field($feedback, 'utm_source')
        ->hiddenInput(['value'=> Visit::getUtm('utm_source'), 'id' => 'quickorder_form_top-utm_source'])
        ->label(false) ?>
    <?= $form->field($feedback, 'utm_medium')
        ->hiddenInput(['value'=> Visit::getUtm('utm_medium'), 'id' => 'quickorder_form_top-utm_medium'])
        ->label(false) ?>
    <?= $form->field($feedback, 'utm_campaign')
        ->hiddenInput(['value'=> Visit::getUtm('utm_campaign'), 'id' => 'quickorder_form_top-utm_campaign'])
        ->label(false) ?>
    <?= $form->field($feedback, 'utm_term')
        ->hiddenInput(['value'=>  Visit::getUtm('utm_term'), 'id' => 'quickorder_form_top-utm_term'])
        ->label(false) ?>
    <?= $form->field($feedback, 'utm_content')
        ->hiddenInput(['value'=> Visit::getUtm('utm_content'), 'id' => 'quickorder_form_top-utm_content'])
        ->label(false) ?>


    <?= $form->field($feedback, 'master_id')
        ->hiddenInput(['value'=>$master['id'],'id' => 'quickorder-form-top-master_id'])
        ->label(false) ?>

<div class="row no-gutters ">
    <!--                тип консультации -->
    <div class="col-sm-6 ">
        <div class="styleSelect">
            <?= $form->field($feedback, 'session_type')
                ->dropDownList(\yii\helpers\ArrayHelper::map(
                    $master->services, 'name','name'),[
                    'id'=>'quickorder-form-top-session',
                    'class'=>'form-control',
                    'prompt'=>'Тип сессии',
                ])
                ->label(false) ?>
        </div>
    </div>
</div>
<div class="row no-gutters ">
    <div class="col-sm-6">
        <?= $form->field($feedback, 'phone')
            ->textInput()->widget(\yii\widgets\MaskedInput::class, [
            'mask' => '+9 999 999-99-99',
            'options' => ['placeholder' => 'Телефон',  'class' => 'form-control transparent']
        ])->label(false); ?>


    </div>
    <div class="col-sm-6 secondColPadding">
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

    <div class="col-sm-12  text-center pb100">
        <?= Html::submitButton(
                isset($model) &&
                        isset($model->call2action_name) &&
                        $model->call2action_name != ''?$model->call2action_name:'Отправить',
                ['class' => 'btn btn-default '.(isset($model) && isset($model['call2action_class'])?$model['call2action_class']:null)]) ?>
    </div>
</div>
<?php $form = ActiveForm::end(); ?>




