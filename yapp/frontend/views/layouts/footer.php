<?php

/* @var $this \yii\web\View */
/* @var $content string */
use \yii\helpers\Html;

?>


<footer class="footer">
    <div class="container ">
        <div class="row text-center">
            <div class="col-sm-4 text-left">
                <p >
                    webmaster@psihotera.ru <br>
                    +7 (985) 346-16-15
                </p>
<!--                --><?php //var_dump( strpos(Yii::$app->request->url,'/article'));die;?>
            </div>
            <div class="col-sm-4">
                <p >Психотера <?= date('Y') ?></p>
            </div>
            <div class="col-sm-4 text-right">
                <?= Html::a('Услуги психотерапевту','/uslugi-psihoterapevtu',['class'=>'menu_link']) ?>
            </div>
        </div>


    </div>
</footer>


