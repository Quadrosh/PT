<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ArticleSectionBlockItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article Section Block Items';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-section-block-item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article Section Block Item', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'article_section_block_id',
            'sort',
            'header',
            'header_class',
            // 'description:ntext',
            // 'text:ntext',
            // 'comment:ntext',
            // 'image:ntext',
            // 'image_alt',
            // 'link_description',
            // 'link_name',
            // 'link_url:url',
            // 'link_class',
            // 'link_comment',
            // 'view',
            // 'color_key',
            // 'structure',
            // 'accent',
            // 'custom_class',
            // 'type',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
