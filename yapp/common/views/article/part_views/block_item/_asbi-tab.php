<?php

use yii\helpers\Html;
use \yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlockItem */
/* @var $block common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */

?>
<?php Pjax::begin([
    'id' => 'asb_tabs-tab_Pjax',
    'timeout' => 2000,
    'enablePushState' => false,
]); ?>
<div class="tab_wrapper asbi-tab background_cover " style=" background-image: url(/img/<?= $model->image ?>)">

    <div class="t_head">
        <?php if ($section->description) : ?>
            <p class="tabs_text_padding tab_head_cursive <?= $section->description_class ?>"><?= nl2br($section->description)  ?></p>
        <?php endif; ?>

        <?php if ($section->header) : ?>
            <h2 class="tabs_text_padding tabs_head <?= $section->header_class ?>"><?= $section->header ?></h2>
        <?php endif; ?>
    </div>
    <div id="item_tab_link_box" >
        <?php foreach ($block->items as $item): ?>
            <?php echo Html::a(
                $item->header,
                ['/article/item-tab-view',
                    'id'=>$item->id,
                    'block_id'=>$block->id,
                    'section_id'=>$section->id,
                ],
                [
                    'data-pjax'=> '#asb_tabs-tab_Pjax',
                    'class'=>$item->id == $model->id?'tabLink active':'tabLink',
                    'id'=>'item_tab_link_'.$item->id,
                ]) ?>
        <?php endforeach ?>
    </div>
    <div class="col-sm-7  tab_text pl0">

        <?php if ($model->description) : ?>
            <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= $model->description ?></p>
        <?php endif; ?>

        <?php if ($model->text) : ?>
            <p <?= $model->text_class?'class="'.$model->text_class.'"':null ?>><?= nl2br($model->text)  ?></p>
        <?php endif; ?>

        <?php if ($model->link_name) : ?>
            <a href="<?= $model->link_url ?>" <?= $model->link_class?'class="'.$model->link_class.'"':null ?>><?= $model->link_name ?></a>
        <?php endif; ?>
        <?php if ($model->link_description) : ?>
            <p class="text-center"><?= $model->link_description ?></p>
        <?php endif; ?>

    </div>


</div>
<?php Pjax::end(); ?>
