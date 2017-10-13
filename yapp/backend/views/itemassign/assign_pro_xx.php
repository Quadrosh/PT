<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$itemAssign = new \common\models\ItemAssign();

?>
<?php Pjax::begin([
    'id' => 'professionAssignPjax',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>
<?php
// профессия - дата во вьюху
$query = \common\models\ItemAssign::find()->where(['item_type'=>'pro','master_id'=>$model['id']]);
$proDataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);
?>
    <div class=" col-sm-6">
        <h4>Профессия</h4>
        <?php $form = ActiveForm::begin([
            'id'=>'professionAssign',
            'action' => ['/itemassign/assignproxx?id='.$model['id']],
//                    'method' => 'post',
            'options' => ['data-pjax' => true ]
        ]); ?>
        <?= $form->field($itemAssign, 'item_type')
            ->hiddenInput(['value'=>'pro','id' => 'pro_assign-item_type'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'item_id')
            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\ProfessionItem::find()->orderBy('name')->all(), 'id','name'))
            ->label(false) ?>
        <?= $form->field($itemAssign, 'article_id')
            ->hiddenInput()
            ->label(false) ?>
        <?= $form->field($itemAssign, 'master_id')
            ->hiddenInput(['value' => $model['id']])
            ->label(false) ?>
        <?= Html::a('Создать', '/professionitem/create',['class' => 'btn btn-success btn-xs']) ?>
        <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-sm-6">

        <?php
        echo yii\grid\GridView::widget([
            'dataProvider' => $proDataProvider,
            'emptyText' => '',
            'columns'=>[
//                        'item_id',
                [
                    'attribute'=>'item_id',
                    'value' => function($data)
                    {
                        $theData = \common\models\ProfessionItem::find()->where(['id'=>$data['item_id']])->one();
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