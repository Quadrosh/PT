<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "b2b_bot_request".
 *
 * @property int $id
 * @property string $update_id
 * @property int $user_id
 * @property int $master_id
 * @property string $request
 * @property string $answer
 * @property string $messenger
 * @property int $user_time
 * @property int $request_time
 * @property int $answer_time
 */
class NotificationRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_request';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
                'createdAtAttribute'=>'request_time',
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['master_id', 'user_id', 'user_time', 'request_time', 'answer_time'], 'integer'],
            [['request', 'answer'], 'string'],
            [['messenger', 'update_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'messenger' => 'Messenger',
            'update_id' => 'Update ID',
            'user_id' => 'User ID',
            'master_id' => 'Master ID',
            'request' => 'Request',
            'answer' => 'Answer',
            'user_time' => 'User Time',
            'request_time' => 'Request Time',
            'answer_time' => 'Answer Time',
        ];
    }
}
