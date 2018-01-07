<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LtTgBotSessionVars */

$this->title = 'Create Lt Tg Bot Session Vars';
$this->params['breadcrumbs'][] = ['label' => 'Lt Tg Bot Session Vars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-tg-bot-session-vars-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
