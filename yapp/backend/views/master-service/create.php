<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MasterService */

$this->title = 'Create Master Service';
$this->params['breadcrumbs'][] = ['label' => 'Master Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="master-service-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
