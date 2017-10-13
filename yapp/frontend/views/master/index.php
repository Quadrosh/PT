<?php
use yii\widgets\ListView;
?>
<div class="site-index">
    <div class="row">
        <div class="col-sm-12 ">
            <h2 class="indexHead">Психотерапевты</h2>
        </div>

        <div class="col-sm-12">
            <?php echo ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_master_list_item',
            ]);?>
        </div>
    </div>



</div>
