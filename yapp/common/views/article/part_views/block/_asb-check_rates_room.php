<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */

$structure = $model->structure;
$dateTo= '';
$dateFrom = '';
$house = \common\models\House::findOne(['hrurl'=>$article->hrurl]) ;
$houseName = $house?$house->name:null;
if ($structure) {
    foreach (explode('&', $structure) as $chunk) {
        $param = explode("=", $chunk);

        if ($param[0]=='to') $dateTo=$param[1];

        if ($param[0]=='from') $dateFrom=$param[1];

//        if ($param[0]=='house_id' || $param[0]=='houseId') $houseId=$param[1];

    }
}


?>
<div class="asb-check_rates_room">

    <?php if ($model->header) : ?>
        <h3 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h3>
    <?php endif; ?>

    <?php if ($model->description) : ?>
        <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= $model->description ?></p>
    <?php endif; ?>


    <?= \common\widgets\CheckRatesRoomWidget::widget([
        'dateTo' => $dateTo,
        'houseName' => $houseName,
        'dateFrom' => $dateFrom,
        'hrurl' => $article->hrurl,
    ]) ?>





    <?php if ($model->items) : ?>
        <ol>
            <?php foreach ($model->items as $item) : ?>
                <li >

                    <?php if ($item->view) : ?>
                        <?= $this->render('/article/part_views/block_item/'.$item->view, [
                            'model' => $item,
                        ]) ?>
                    <?php endif; ?>

                    <?php if (!$item->view) : ?>
                        <?php if ($item->header) : ?>
                            <h4 <?= $item->header_class?'class="'.$item->header_class.'"':null ?>><?= $item->header ?></h4>
                        <?php endif; ?>
                        <?php if ($item->description) : ?>
                            <p <?= $item->description_class?'class="'.$item->description_class.'"':null ?>><?= $item->description ?></p>
                        <?php endif; ?>
                        <?php if ($item->image) : ?>
                            <?= Html::img('/img/'.$item->image,['class'=>'max-w100per '.$item->image_class,
                                'alt'=>$item->image_alt,
                                'title'=>$item->image_title?$item->image_title:null])  ?>
                        <?php endif; ?>
                        <?php if ($item->link_name) : ?>
                            <a href="<?= $item->link_url ?>" <?= $item->link_class?'class="'.$item->link_class.'"':null ?>><?= $item->link_name ?></a>
                        <?php endif; ?>
                        <?php if ($item->link_description) : ?>
                            <p class="text-center"><?= $item->link_description ?></p>
                        <?php endif; ?>

                        <?php if ($item->text) : ?>
                            <p ><?= nl2br($item->text) ?></p>
                        <?php endif; ?>

                    <?php endif; ?>

                </li>
            <?php endforeach; ?>
        </ol>
        <?php if ($model->raw_text) : ?>
            <p <?= $model->raw_text_class?'class="'.$model->raw_text_class.'"':null ?>><?= nl2br($model->raw_text) ?></p>
        <?php endif; ?>

    <?php endif; ?>

</div>

