<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<div class=" col-sm-6">
    <h4>Назначение сайта источника</h4>

    <?php $form = ActiveForm::begin([
        'method' => 'post',
        'action' => ['/itemassign/assignjax'],
        'options' => ['enctype' => 'multipart/form-data','data-pjax' => true ],
    ]); ?>
    <?= $form->field($itemAssign, 'item_type')
        ->hiddenInput(['value'=>'site','id' => 'psy_assign-item_type'])
        ->label(false) ?>
    <?= $form->field($itemAssign, 'item_id')
        ->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\SiteItem::find()->all(), 'id','name'))
        ->label(false) ?>
    <?= $form->field($itemAssign, 'article_id')
        ->hiddenInput()
        ->label(false) ?>
    <?= $form->field($itemAssign, 'master_id')
        ->hiddenInput(['value' => $model['id']])
        ->label(false) ?>


    <?= Html::submitButton('Назначить <i class="fa fa-share" aria-hidden="true"></i>', ['class' => 'btn btn-primary btn-xs']) ?>
    <?php ActiveForm::end() ?>

</div>


<div class="col-sm-6">

    <table class="table table-striped table-bordered">
        <thead>
        <tr>

            <th>Назначенные сайты</th>
            <th class="action-column">&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($siteAssigns as $siteAssign) : ?>
            <tr >

                <td><a href="<?= $siteAssign['link']  ?>"><?= $siteAssign['name']  ?></a> </td>

                <td>

                    <a href="/itemassign/delete?id=<?= $siteAssign['id'] ?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-pjax="0"  data-method="post"><span class="glyphicon glyphicon-trash"></span></a>


                </td>
            </tr>
        <?php endforeach; ?>


        </tbody>
    </table>
</div>