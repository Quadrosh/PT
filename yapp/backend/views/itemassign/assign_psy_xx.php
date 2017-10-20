<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$itemAssign = new \common\models\ItemAssign();

?>
<?php Pjax::begin([
    'id' => 'psyAssignPjax',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>
<?php
// вид психотерапии - дата во вьюху
if ($type == 'article') {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'psy','article_id'=>$articleId]);
} else {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'psy','master_id'=>$masterId]);
}

$psyDataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);
?>
    <div class=" col-sm-6">
        <h4>Подход психотерапии</h4>
        <?php $form = ActiveForm::begin([
            'id'=>'psyAssign',
            'action' => ['/itemassign/assignpsyxx?type='.$type.'&id='.$id],
//                    'method' => 'post',
            'options' => ['data-pjax' => true ]
        ]); ?>
        <?= $form->field($itemAssign, 'item_type')
            ->hiddenInput(['value'=>'psy','id' => 'psy_assign-item_type'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'item_id')
            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\PsychotherapyItem::find()->orderBy('name')->all(), 'id','name'),['id'=>'psy_assign-item_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'article_id')
            ->hiddenInput(['value' => $articleId,'id' => 'psy_assign-article_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'master_id')
            ->hiddenInput(['value' => $masterId,'id' => 'psy_assign-master_id'])
            ->label(false) ?>
        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/psychotherapyitem/create',['class' => 'btn btn-success btn-xs']) ?>
        <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-sm-6">

        <?php
        echo yii\grid\GridView::widget([
            'dataProvider' => $psyDataProvider,
            'emptyText' => '',
            'columns'=>[
//                        'item_id',
                [
                    'label' => 'Назначено',
                    'attribute'=>'item_id',
                    'value' => function($data)
                    {
                        $theData = \common\models\PsychotherapyItem::find()->where(['id'=>$data['item_id']])->one();
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