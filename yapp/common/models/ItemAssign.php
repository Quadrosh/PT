<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "item_assign".
 *
 * @property integer $id
 * @property string $item_type
 * @property integer $item_id
 * @property integer $article_id
 * @property integer $master_id
 * @property integer $updated_at
 * @property integer $created_at
 */
class ItemAssign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_assign';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_type', 'item_id'], 'required'],
            [['item_id', 'article_id', 'master_id', 'updated_at', 'created_at'], 'integer'],
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
            'item_type' => 'Item Type',
            'item_id' => 'Item ID',
            'article_id' => 'Article ID',
            'master_id' => 'Master ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
