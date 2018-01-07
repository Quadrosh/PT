<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tg_bot_user".
 *
 * @property int $id
 * @property int $tg_user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $language_code
 * @property int $updated_at
 * @property int $created_at
 */
class TgBotUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tg_bot_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tg_user_id', 'updated_at', 'created_at'], 'integer'],
            [['username'], 'required'],
            [['first_name', 'last_name', 'username', 'language_code'], 'string', 'max' => 255],
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'username' => 'Username',
            'language_code' => 'Language Code',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
