<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Article */





?>
<div class="article-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($model['link2original'] == 'masterpage') {
        $this->title = 'Update Master Text: ' . $model->title;
        $this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['/master/index']];
        $this->params['breadcrumbs'][] = ['label' => $model->master['username'], 'url' => ['/master/view?id='.$model['master_id']]];
        $this->params['breadcrumbs'][] = ['label' => 'Тексты мастера', 'url' => ['master-texts?master_id='.$model['master_id']]];
        $this->params['breadcrumbs'][] = ['label' => $model['list_name'] ];
       echo $this->render('_mt_form', [
            'model' => $model,
        ]);
    } else {
        $this->title = 'Update Article: ' . $model->title;
        $this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
        $this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
        $this->params['breadcrumbs'][] = 'Update';
        echo $this->render('_form', [
            'model' => $model,
        ]);
    }
     ?>

</div>
