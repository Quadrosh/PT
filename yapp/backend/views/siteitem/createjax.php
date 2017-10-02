<?php
use yii\widgets\Pjax;
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<?php Pjax::begin(['id' => 'site_create','timeout'=>2000]); ?>

<?= Html::beginForm(['siteitem/createjax'], 'post', ['data-pjax' => '', 'class' => 'form-inline']); ?>
<?= Html::input('text', 'name', Yii::$app->request->post('name'), ['class' => 'form-control']) ?>
<?= Html::input('text', 'link', Yii::$app->request->post('link'), ['class' => 'form-control']) ?>
<?= Html::hiddenInput('text',  Yii::$app->request->post('master_id'), ['value' => $model['id']]) ?>
<?= Html::submitButton('отправить данные', ['class' => 'btn btn-xs btn-primary', 'name' => 'hash-button']) ?>
<?= Html::endForm() ?>

<?php Pjax::end(); ?>