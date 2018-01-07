<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lt_tg_bot_session".
 *
 * @property int $id
 * @property int $tg_user_id
 * @property int $item_id
 * @property string $item_type
 * @property string $description
 * @property string $user_response
 * @property int $remind_date
 * @property string $remind_text
 * @property int $created_at
 */
class LtTgBotSession extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lt_tg_bot_session';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tg_user_id'], 'required'],
            [['tg_user_id', 'item_id', 'remind_date', 'created_at'], 'integer'],
            [['description', 'user_response', 'remind_text'], 'string'],
            [['item_type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tg_user_id' => 'Tg User ID',
            'item_id' => 'Item ID',
            'item_type' => 'Item Type',
            'description' => 'Description',
            'user_response' => 'User Response',
            'remind_date' => 'Remind Date',
            'remind_text' => 'Remind Text',
            'created_at' => 'Created At',
        ];
    }
}
