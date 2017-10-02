<?php
use yii\widgets\ListView;
?>
<div class="site-index">

    Мастер индекс


    <?php echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_master_list_item',
    ]);?>


</div>
