<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tg_bot_use".
 *
 * @property int $id
 * @property int $user_id
 * @property int $item_id
 * @property string $item_type
 * @property string $bot_name
 * @property string $done
 * @property string $user_result
 * @property int $created_at
 */
class TgBotUse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tg_bot_use';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'item_id', 'created_at'], 'integer'],
            [['bot_name'], 'required'],
            [['user_result'], 'string'],
            [['item_type', 'bot_name', 'done'], 'string', 'max' => 255],
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
            'item_id' => 'Item ID',
            'item_type' => 'Item Type',
            'bot_name' => 'Bot Name',
            'done' => 'Done',
            'user_result' => 'User Result',
            'created_at' => 'Created At',
        ];
    }
}
