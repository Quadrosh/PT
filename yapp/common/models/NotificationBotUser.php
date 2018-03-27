<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "notification_bot_user".
 *
 * @property int $id
 * @property int $master_id
 * @property string $messenger
 * @property string $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $real_first_name
 * @property string $real_last_name
 * @property string $email
 * @property string $phone
 * @property string $status
 * @property string $bot_command
 * @property int $updated_at
 * @property int $created_at
 */
class NotificationBotUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notification_bot_user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
//                'updatedAtAttribute' => false,
//                'createdAtAttribute'=>'request_time',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_id', 'updated_at', 'created_at'], 'integer'],
            [['messenger', 'user_id', 'first_name', 'last_name', 'username', 'real_first_name', 'real_last_name', 'email', 'phone', 'status', 'bot_command'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'messenger' => 'Messenger',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'real_first_name' => 'Real First Name',
            'real_last_name' => 'Real Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'status' => 'Status',
            'bot_command' => 'Bot Command',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
