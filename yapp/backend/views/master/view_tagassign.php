<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php Pjax::begin(['id' => 'tagAssignPjax', 'timeout' => 2000 ]); ?>

    <div class=" col-sm-6">
        <h4>Назначение меток</h4>
        <?php $form = ActiveForm::begin([
            'method' => 'post',
            'action' => ['/tagassign/assign'],
            'options' => ['enctype' => 'multipart/form-data'],
        ]); ?>
        <?= $form->field($tagAssign, 'tag_id')->dropDownList(\yii\helpers\ArrayHelper::map(\common\models\Tag::find()->all(), 'id','name'))->label(false) ?>
        <?= $form->field($tagAssign, 'article_id')->hiddenInput()->label(false) ?>
        <?= $form->field($tagAssign, 'master_id')->hiddenInput(['value' => $model['id']])->label(false) ?>


        <?= Html::submitButton('Назначить', ['class' => 'btn btn-primary btn-xs']) ?>
        <?php ActiveForm::end() ?>
    </div>

    <div class="col-sm-6">

        <table class="table table-striped table-bordered">
            <thead>
            <tr>

                <th>Назначенные метки</th>
                <th class="action-column">&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($tags as $tag) : ?>
                <tr >
                    <td><?= $tag['name'] ?></td>

                    <td>

                        <a href="/tagassign/delete?id=<?= $tag['id'] ?>" title="Delete" aria-label="Delete" data-confirm="Are you sure you want to delete this item?" data-pjax="0"  data-method="post"><span class="glyphicon glyphicon-trash"></span></a>


                    </td>
                </tr>
            <?php endforeach; ?>


            </tbody>
        </table>
    </div>
<?php Pjax::end(); ?>