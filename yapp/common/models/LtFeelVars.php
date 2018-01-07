<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lt_feel_vars".
 *
 * @property int $id
 * @property int $feel_id
 * @property string $question
 * @property string $example
 * @property int $created_at
 */
class LtFeelVars extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lt_feel_vars';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['feel_id', 'created_at'], 'integer'],
            [['question'], 'string'],
            [['example'], 'string', 'max' => 510],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'feel_id' => 'Feel ID',
            'question' => 'Question',
            'example' => 'Example',
            'created_at' => 'Created At',
        ];
    }
}
