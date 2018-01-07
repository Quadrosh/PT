<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tg_bot_user_permission".
 *
 * @property int $id
 * @property int $user_id
 * @property string $short
 * @property string $description
 * @property int $created_at
 */
class TgBotUserPermission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tg_bot_user_permission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'created_at'], 'integer'],
            [['description'], 'string'],
            [['short'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'short' => 'Short',
            'description' => 'Description',
            'created_at' => 'Created At',
        ];
    }
}
