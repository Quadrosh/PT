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

<h2 class="articleName"><?= $article['pagehead']?></h2>
<p><?= $article['text']?></p>



<?php Pjax::end(); ?>