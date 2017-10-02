<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\PsychotherapyItem */

$this->title = 'Create Psychotherapy Item';
$this->params['breadcrumbs'][] = ['label' => 'Psychotherapy Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="psychotherapy-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
