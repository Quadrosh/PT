<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "lt_restriction".
 *
 * @property int $id
 * @property string $item_type
 * @property int $item_id
 * @property string $short
 * @property string $name
 * @property string $description
 * @property string $text
 * @property int $created_at
 * @property int $updated_at
 */
class LtRestriction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lt_restriction';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
//                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id', 'created_at', 'updated_at'], 'integer'],
            [['description', 'text'], 'string'],
            [['item_type', 'name'], 'string', 'max' => 255],
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
            'item_type' => 'Item Type',
            'item_id' => 'Item ID',
            'short' => 'Short',
            'name' => 'Name',
            'description' => 'Description',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
