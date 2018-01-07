<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LtFeelVars */

$this->title = 'Create Lt Feel Vars';
$this->params['breadcrumbs'][] = ['label' => 'Lt Feel Vars', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-feel-vars-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
