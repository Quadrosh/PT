<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LtTgBotSession */

$this->title = 'Create Lt Tg Bot Session';
$this->params['breadcrumbs'][] = ['label' => 'Lt Tg Bot Sessions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-tg-bot-session-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
