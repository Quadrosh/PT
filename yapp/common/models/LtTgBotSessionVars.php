<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lt_tg_bot_session_vars".
 *
 * @property int $id
 * @property int $lo_bot_session_id
 * @property int $step_number
 * @property string $step_text
 * @property string $user_response
 * @property int $created_at
 */
class LtTgBotSessionVars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lt_tg_bot_session_vars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lo_bot_session_id', 'step_number'], 'required'],
            [['lo_bot_session_id', 'step_number', 'created_at'], 'integer'],
            [['step_text', 'user_response'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lo_bot_session_id' => 'Lo Bot Session ID',
            'step_number' => 'Step Number',
            'step_text' => 'Step Text',
            'user_response' => 'User Response',
            'created_at' => 'Created At',
        ];
    }
}
