<?php

/* @var $this yii\web\View */
use \yii\helpers\Html;
?>




<div class="container">
    <div class="site-index">

        <div class="row ">

            <div class="col-sm-12">
                <h2 class="indexHead">Результат поиска в разделе "Статьи"</h2>
                <?php echo \yii\widgets\ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => '_article_list_item',
                ]);?>
            </div>
        </div>




    </div>
</div>

