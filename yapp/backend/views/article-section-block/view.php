<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Article Section Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-section-block-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'article_section_id',
            'sort',
            'header',
            'header_class',
            'description:ntext',
            'raw_text:ntext',
            'image:ntext',
            'image_alt',
            'image_title',
            'background_image:ntext',
            'background_image_title:ntext',
            'thumbnail_image:ntext',
            'thumbnail_image_alt:ntext',
            'thumbnail_image_title:ntext',
            'call2action_description',
            'call2action_name',
            'call2action_link',
            'call2action_class',
            'call2action_comment',
            'view',
            'color_key',
            'structure',
//            'accent',
            [
                'attribute'=>'accent',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asBoolean($data['accent']);
                },
                'format'=> 'html',
            ],
            'custom_class',
            [
                'attribute'=>'created_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['created_at'], 'dd/MM/yy HH:mm');
                },
                'format'=> 'html',
            ],
            [
                'attribute'=>'updated_at',
                'value' => function($data)
                {
                    return \Yii::$app->formatter->asDatetime($data['updated_at'], 'dd/MM/yy HH:mm');
                },
                'format'=> 'html',
            ],
        ],
    ]) ?>

</div>
