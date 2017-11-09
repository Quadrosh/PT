<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$itemAssign = new \common\models\ItemAssign();

?>
<?php Pjax::begin([
    'id' => 'sessionAssignPjax',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>
<?php
// вид сессии - дата во вьюху
if ($type == 'article') {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'session','article_id'=>$articleId]);
} else {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'session','master_id'=>$masterId]);
}

$sessionTypeDataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);
?>
    <div class=" col-sm-6">
        <h4>Виды сессий и цена</h4>
        <?php $form = ActiveForm::begin([
            'id'=>'sessionAssign',
            'action' => ['/itemassign/assign-session-xx?type=master&id='.$masterId],
            'options' => ['data-pjax' => true ]
        ]); ?>
        <?= $form->field($itemAssign, 'item_type')
            ->hiddenInput(['value'=>'session','id' => 'session_assign-item_type'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'article_id')
            ->hiddenInput(['value' => '','id' => 'session_assign-article_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'master_id')
            ->hiddenInput(['value' => $masterId,'id' => 'session_assign-master_id'])
            ->label(false) ?>
        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($itemAssign, 'item_id')
                    ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SessionTypeItem::find()->orderBy('name')->all(), 'id','name'),['id'=>'session_assign-item_id'])
                    ->label('вид') ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($itemAssign, 'value')
                    ->textInput(['id' => 'session_assign-master_id'])
                    ->label('цена') ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($itemAssign, 'comment')
                    ->textInput(['id' => 'session_assign-master_id'])
                    ->label('коммент - р/2ч') ?>
            </div>
        </div>


        <?= Html::a('<i class="fa fa-plus" aria-hidden="true"></i> Создать', '/session-type-item/create',['class' => 'btn btn-success btn-xs']) ?>
        <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-sm-6">

        <?php
        echo yii\grid\GridView::widget([
            'dataProvider' => $sessionTypeDataProvider,
            'emptyText' => '',
            'columns'=>[
//                        'item_id',
                [
                    'label' => 'Назначено',
                    'attribute'=>'item_id',
                    'value' => function($data)
                    {
                        $theData = \common\models\SessionTypeItem::find()->where(['id'=>$data['item_id']])->one();
                        return $theData['name'];
                    },
                ],
                'value',
                'comment',
                [
                    'class' => \yii\grid\ActionColumn::className(),
                    'buttons' => [
                        'update'=>function($url,$model){
                            $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/update','id'=>$model['id']]);
                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-pencil"></span>', $newUrl,
                                ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                        },
                        'delete'=>function($url,$model){
                            $newUrl = Yii::$app->getUrlManager()->createUrl(['/itemassign/delete','id'=>$model['id']]);
                            return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $newUrl,
                                ['title' => Yii::t('yii', 'Удалить'), 'data-pjax' => '0','data-method'=>'post']);
                        },
                        'view'=>function($url,$model){
                            return false;
                        },


                    ]
                ],
            ],
        ]);
        ?>

    </div>
<?php Pjax::end(); ?>