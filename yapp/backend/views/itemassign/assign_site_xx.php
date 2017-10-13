<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use yii\widgets\Pjax;

$itemAssign = new \common\models\ItemAssign();

?>
<?php Pjax::begin([
    'id' => 'siteAssignPjax',
    'timeout' => 2000,
    'enablePushState' => false
]); ?>
<?php
// сайт - дата во вьюху
if ($type == 'article') {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'site','article_id'=>$articleId]);
} else {
    $query = \common\models\ItemAssign::find()->where(['item_type'=>'site','master_id'=>$masterId]);
}

$siteDataProvider = new \yii\data\ActiveDataProvider([
    'query'=>$query,
]);
?>
    <div class=" col-sm-6">
        <h4>Сайт</h4>
        <?php $form = ActiveForm::begin([
            'id'=>'psyAssign',
            'action' => ['/itemassign/assignsitexx?type='.$type.'&id='.$id],
//                    'method' => 'post',
            'options' => ['data-pjax' => true ]
        ]); ?>
        <?= $form->field($itemAssign, 'item_type')
            ->hiddenInput(['value'=>'site','id' => 'site_assign-item_type'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'item_id')
            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SiteItem::find()->all(), 'id','name'),['id'=>'site_assign-item_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'article_id')
            ->hiddenInput(['value' => $articleId,'id' => 'site_assign-article_id'])
            ->label(false) ?>
        <?= $form->field($itemAssign, 'master_id')
            ->hiddenInput(['value' => $masterId,'id' => 'site_assign-master_id'])
            ->label(false) ?>
        <?= Html::a('Создать', '/siteitem/create',['class' => 'btn btn-success btn-xs']) ?>
        <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
        <?php ActiveForm::end() ?>
    </div>
    <div class="col-sm-6">

        <?php
        echo yii\grid\GridView::widget([
            'dataProvider' => $siteDataProvider,
            'emptyText' => '',
            'columns'=>[
//                        'item_id',
                [
                    'label' => 'Назначено',
                    'attribute'=>'item_id',
                    'value' => function($data)
                    {
                        $theData = \common\models\SiteItem::find()->where(['id'=>$data['item_id']])->one();
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