<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TgBotUser */

$this->title = 'Create Tg Bot User';
$this->params['breadcrumbs'][] = ['label' => 'Tg Bot Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tg-bot-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
