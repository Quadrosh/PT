<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Article */
$master = \common\models\Master::find()->where(['id'=>Yii::$app->request->get('master_id')])->one();

$this->title = 'Создать текст мастера';
$this->params['breadcrumbs'][] = ['label' => 'Masters', 'url' => ['/master/index']];
$this->params['breadcrumbs'][] = ['label' => $master['username'], 'url' => ['/master/view?id='.$master['id']]];
$this->params['breadcrumbs'][] = ['label' => 'Тексты мастера', 'url' => ['master-texts?master_id='.$master['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_mt_form', [
        'model' => $model,
    ]) ?>

</div>
