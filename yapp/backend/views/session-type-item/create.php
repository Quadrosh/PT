<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SessionTypeItem */

$this->title = 'Create Session Type Item';
$this->params['breadcrumbs'][] = ['label' => 'Session Type Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="session-type-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
