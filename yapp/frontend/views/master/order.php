<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$master = \common\models\Master::find()->where(['hrurl'=>Yii::$app->request->get('hrurl')])->one();
$feedback = new \common\models\Feedback;
?>
<?php Pjax::begin([
    'id' => 'masterArticleText',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>

    <?= $this->render('_order', [
        'master' => $master,
        'feedback' => $feedback,
    ]) ?>


<?php Pjax::end(); ?>