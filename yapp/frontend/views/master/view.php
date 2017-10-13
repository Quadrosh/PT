<?php
use \yii\helpers\Html;
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
$feedback = new \common\models\Feedback;

?>
<div class="<?= $master['stylekey'] ?>">
    <div class="row ">
        <div class="col-xs-12 less480">
            <div class="masterImageBox">
                <?= cl_image_tag($master->imagefile['cloudname'], [
                    "alt" => $master['image_alt'],
                    "width" => 167,
                    "height" => 180,
                    "crop" => "fill",
                    "gravity" => "face"
                ]); ?>
            </div>
        </div>
        <div class="col-xs-3 col-sm-4 more480">
            <div class="masterImageBox">
                <?= Html::img('/img/th-'.$master['image'],['class'=>'masterPageAvatar']) ?>
                <?= cl_image_tag($master->imagefile['cloudname'], [
                    "alt" => $master['image_alt'],
                    "width" => 167,
                    "height" => 180,
                    "crop" => "fill",
                    "gravity" => "face"
                ]); ?>
            </div>
        </div>
        <div class="col-xs-9 col-sm-8">
            <h1 class="masterPageUsername"><?= $master['username'] ?></h1>

            <?php if (isset($masterData['professions'])) : ?>
                <?php $count = 1?>
                <p class="masterProfession">
                    <?php foreach ($masterData['professions'] as $profession) {
                        if ($count != count($masterData['professions'])) {
                            echo '<span class="';
                            echo $count==1 ?' capital':' lowercase';
                            echo '">'.$profession['name'].'</span>';
                            echo count($masterData['professions'])>1 ? ', ':'';
                        } else {
                            echo '<span class=" lowercase">'.$profession['name'].'</span>';
                        }
                        $count++;
                    } ?>
                </p>
            <?php endif; ?>


            <div class="divider"></div>


            <?php if (isset($masterData['psys'])) : ?>
                <?php $psyCount = 1?>
                <p class="masterPsychotherapy">
                    <?php foreach ($masterData['psys'] as $psychotherapyType) : ?>
                    <?php if ($psyCount != count($masterData['psys'])) {
                           echo '<span class="';
                            echo $psyCount==1 ?' capital':' lowercase';
                            echo '">'.$psychotherapyType['name'].'</span>';
                            echo count($masterData['psys'])>1 ? ', ':'';
                        } else {
                            echo '<span class=" lowercase">'.$psychotherapyType['name'].'</span>';
                        }
                        $psyCount++;
                        ?>
                    <?php endforeach; ?>
                </p>
            <?php endif; ?>


<!--            --><?php //if (isset($masterData['psys'])) : ?>
<!--                --><?php //foreach ($masterData['psys'] as $psychotherapyType) : ?>
<!--                    <i class="masterPsychotherapy">--><?//= Html::encode($psychotherapyType['name']) ?><!--</i> <br>-->
<!--                --><?php //endforeach; ?>
<!--            --><?php //endif; ?>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <ul class="links">
                <?php foreach ($masterPages as $masterPage) : ?>
                    <li><?=  Html::a( $masterPage['list_name'], '/master/'.$master['hrurl'].'/'.$masterPage['hrurl'],
                            ['class'=>'pjax_btn']);
                        ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-sm-8 noPaddingLess480">
            <div id="contentBox" class="contentBox">

                <?php Pjax::begin([
                    'id' => 'masterArticleText',
//                'container'=>'masterArticleTextContainer',

                    'timeout' => 2000,
                    'enablePushState' => false,
                ]); ?>

                <?php if ($article!=null) : ?>
                    <?php if($article=='go') : ?>
                        <p>Прием осуществляется по адресу:<br>  <?= nl2br($master['address']) ?> </p>
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
                    <?php endif; ?>
                    <?php if($article=='otziv') : ?>
                        <p>Отзывы</p>
                    <?php endif; ?>

                    <?php if($article!='otziv' && $article!='go') : ?>
                        <h2 class="articleName"><?= $article['pagehead']?></h2>
                        <p><?= $article['text']?></p>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if($article==null) : ?>
                    <p><?= $master['hello'] ?></p>
                <?php endif; ?>


                <?php Pjax::end(); ?>
            </div>
            <div class="masterFooter text-center">
                <div class="button">
                    <?=  Html::a( 'Записаться', '/master/'.$master['hrurl'].'/go',
                        ['class'=>'pjax_btn btn-default']); ?>
                </div>
                <div class="button">
                    <?=  Html::a( 'Отзывы', '/master/'.$master['hrurl'].'/otziv',
                        ['class'=>'pjax_btn btn-link']); ?>
                </div>

                <p class="address"><?= nl2br($master['address']) ?></p>
            </div>
        </div>
    </div>
</div>
