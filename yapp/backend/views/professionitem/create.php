<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProfessionItem */

$this->title = 'Create Profession Item';
$this->params['breadcrumbs'][] = ['label' => 'Profession Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profession-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
