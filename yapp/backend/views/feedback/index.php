<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use \common\models\Feedback;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заявки';
$this->params['breadcrumbs'][] = $this->title;
$mastersById = \common\models\Master::find()
    ->indexBy('id')
    ->select(['id','name','middlename','surname','username'])
    ->asArray()
    ->all()
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
<!--        --><?//= Html::a('Create Feedback', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>

    <div class="grid-scrollable">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                ['class' => 'yii\grid\ActionColumn'],

                'id',
//            'user_id',
//            'type',
                [
                    'attribute'=>'type',
                    'value' => function($data)  {
                        if ($data->type == Feedback::TYPE_TO_MASTER) {
                            return 'мастеру';
                        } else if ($data->type == Feedback::TYPE_TO_PSIHOTERA) {
                            return 'Психотере';
                        } else {
                            return $data->type;
                        }
                    },
                    'format'=> 'html',
                ],
                'master_id',
                [
                    'attribute'=>'master_id',
                    'value' => function($data) use ($mastersById) {
                        if ($data->master_id) {
                            return $mastersById[$data->master_id]['username'];
                        }
                    },
                    'format'=> 'html',
                    'label'=>'мастер'
                ],
                'name',
                'phone',

                'session_type',

//            'city',

                // 'email:email',
                // 'contacts',
                'text:ntext',
//             'date',
                [
                    'attribute'=>'date',
                    'value' => function($data)
                    {
                        return \Yii::$app->formatter->asDatetime($data['date'], 'dd/MM/yy HH:mm');
                    },
                    'format'=> 'html',
                ],
                // 'done',
                'utm_source',
                'utm_medium',
                'utm_campaign',
                'utm_term',
                'utm_content',
                'send_time',
                'send_status',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>

<?php Pjax::end(); ?></div>
