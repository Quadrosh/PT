<?php

/* @var $this yii\web\View */

?>
<div class="site-index">

    <h4>Отбор по <?= $filterName ?></h4>

    <?php echo \yii\widgets\ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_article_list_item',
    ]);?>

</div>
