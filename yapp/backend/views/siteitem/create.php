<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\SiteItem */

$this->title = 'Create Site Item';
$this->params['breadcrumbs'][] = ['label' => 'Site Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
