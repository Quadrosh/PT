<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$itemAssign = new \common\models\ItemAssign();



//'action' => ['/itemassign/assignsitexx?type='.$type.'&id='.$id],

?>



<?php Pjax::begin([
    'id' => 'masterPageAssignPjax',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>
<?php
if ($type == 'article') {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'site','article_id'=>$articleId]);
} else {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'site','master_id'=>$masterId]);
}
$masterPageDataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);
?>
    <div class=" col-sm-6">
        <h4>Сайт</h4>
        <?php $form = ActiveForm::begin([
            'id'=>'siteAssign',
            'action' => ['/itemassign/assignmpagexx?type='.$type.'&id='.$id],
//                    'method' => 'post',
            'options' => ['data-pjax' => true ]
        ]); ?>
        <?= $form->field($itemAssign, 'item_type')
            ->hiddenInput(['value'=>'masterpage','id' => 'masterPageAssign-item_type'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'item_id')
            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\MasterpageItem::find()->all(), 'id','name'),['id'=>'masterPageAssign-item_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'article_id')
            ->hiddenInput(['value' => $articleId,'id' => 'masterPageAssign-article_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'master_id')
            ->hiddenInput(['value' => $masterId,'id' => 'masterPageAssign-master_id'])
            ->label(false) ?>
        <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-sm-6">

        <?php
        echo yii\grid\GridView::widget([
            'dataProvider' => $masterPageDataProvider,
            'columns'=>[
//                        'item_id',
                [
                    'label' => 'Назначено',
                    'attribute'=>'item_id',
                    'value' => function($data)
                    {
                        $theData = \common\models\MasterpageItem::find()->where(['id'=>$data['item_id']])->one();

                        return  Html::a($theData['name'],$theData['link']);
                    },
                    'format' => 'raw',
                ],
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'buttons' => [
                        'delete'=>function($url,$model){
                            $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
//                                        ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => true,]);
                                ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                        },
                        'view'=>function($url,$model){
                            return false;
                        },
                        'update'=>function($url,$model){
                            return false;
                        },

                    ]
                ],
            ],
        ]);
        ?>

    </div>
<?php Pjax::end(); ?>

