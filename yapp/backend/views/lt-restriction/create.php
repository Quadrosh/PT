<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\LtRestriction */

$this->title = 'Create Lt Restriction';
$this->params['breadcrumbs'][] = ['label' => 'Lt Restrictions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lt-restriction-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
