<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tagassign */

$this->title = 'Create Tagassign';
$this->params['breadcrumbs'][] = ['label' => 'Tagassigns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagassign-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
