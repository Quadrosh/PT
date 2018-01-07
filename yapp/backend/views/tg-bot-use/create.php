<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TgBotUse */

$this->title = 'Create Tg Bot Use';
$this->params['breadcrumbs'][] = ['label' => 'Tg Bot Uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tg-bot-use-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
