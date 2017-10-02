<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;


?>
<?php Pjax::begin([
    'id' => 'masterArticleText',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>

<!--        <p>Записаться на сессию можно потелефону --><?//= $master['phone'] ?><!-- </p>-->
    <p>Отзывы </p>



<?php Pjax::end(); ?>