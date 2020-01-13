<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSectionBlock */
/* @var $section common\models\ArticleSection */
/* @var $block common\models\ArticleSectionBlock */
/* @var $item common\models\ArticleSectionBlockItem */

$structure = $model->structure;
$bank = '';
$calc_code = '';
$sumMessage ='';
$timeMessage ='';
$resultMessage ='';
$infoMessage ='';
$view ='';
$only ='';
if ($structure) {
    foreach (explode('&', $structure) as $chunk) {
        $param = explode("=", $chunk);
        if ($param[0]=='bank') {
            $bank=$param[1];
        }
        if ($param[0]=='calc_code' || $param[0]=='calc') {
            $calc_code=$param[1];
        }
        if ($param[0]=='sum_message' || $param[0]=='sumMessage' ) {
            $sumMessage=$param[1];
        }
        if ($param[0]=='time_message' || $param[0]=='timeMessage' ) {
            $timeMessage=$param[1];
        }
        if ($param[0]=='result_message' || $param[0]=='resultMessage' ) {
            $resultMessage=$param[1];
        }
        if ($param[0]=='info_message' || $param[0]=='infoMessage' ) {
            $infoMessage=$param[1];
        }
        if ($param[0]=='view' ) {
            $view=$param[1];
        }
        if ($param[0]=='only' ) {
            $only=$param[1];
        }
    }
}
if (!$calc_code) {
  $calc_code = 'main_bg';
}


?>
<div class="asb-price-calculator">

    <?php if ($model->header) : ?>
        <h3 <?= $model->header_class?'class="'.$model->header_class.'"':null ?>><?= $model->header ?></h3>
    <?php endif; ?>

    <?php if ($model->description) : ?>
        <p <?= $model->description_class?'class="'.$model->description_class.'"':null ?>><?= $model->description ?></p>
    <?php endif; ?>


    <?php
    if ($calc_code == 'main_tz') {
        echo \common\widgets\MainTzCalculatorWidget::widget([
            'bank' => $bank,
            'calc_code' => $calc_code,
        ]);
    } else {
        echo \common\widgets\MainBgCalculatorWidget::widget([
            'bank' => $bank,
            'calc_code' => $calc_code,
            'view' => $view,
            'only' => $only,
            'data'=> [
                'sumMessage' => $sumMessage,
                'timeMessage' => $timeMessage,
                'resultMessage' => $resultMessage,
                'infoMessage' => $infoMessage,
            ]

        ]);
    }  ?>



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
                            <?= Html::img('/img/'.$item->image,['class'=>'w100'])  ?>
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

