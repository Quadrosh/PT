<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    Статьи индекс

    <?php echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_article_list_item',
    ]);?>

</div>
