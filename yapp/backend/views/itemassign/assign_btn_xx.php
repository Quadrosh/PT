<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$itemAssign = new \common\models\ItemAssign();

?>
<?php Pjax::begin([
    'id' => 'btnAssignPjax',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>
<?php
// кнопки - дата во вьюху
if ($type == 'article') {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'btn','article_id'=>$articleId]);
} else {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'btn','master_id'=>$masterId]);
}

$btnDataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);
?>
    <div class=" col-sm-6">
        <h4>Кнопки</h4>
        <?php $form = ActiveForm::begin([
            'id'=>'btnAssign',
//            'action' => ['/itemassign/assignbtnxx?id='.$model['id']],
            'action' => ['/itemassign/assignbtnxx?type='.$type.'&id='.$id],

            'options' => ['data-pjax' => true ]
        ]); ?>
        <?= $form->field($itemAssign, 'item_type')
            ->hiddenInput(['value'=>'btn','id' => 'btn_assign-item_type'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'item_id')
            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\BtnItem::find()->all(), 'id','name'),['id'=>'btn_assign-item_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'article_id')
            ->hiddenInput(['value' => $articleId,'id' => 'btn_assign-article_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'master_id')
            ->hiddenInput(['value' => $masterId,'id' => 'btn_assign-master_id'])
            ->label(false) ?>
        <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-sm-6">

        <?php
        echo yii\grid\GridView::widget([
            'dataProvider' => $btnDataProvider,
            'columns'=>[
//                        'item_id',
                [
                    'label' => 'Назначено',
                    'attribute'=>'item_id',
                    'value' => function($data)
                    {
                        $theData = \common\models\BtnItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    },
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