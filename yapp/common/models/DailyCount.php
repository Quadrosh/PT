<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "daily_count".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $master_id
 * @property integer $count
 * @property integer $updated_at
 * @property integer $created_at
 */
class DailyCount extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'daily_count';
    }

    /**
     * @inheritdoc
     */
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
            [['article_id', 'master_id', 'count', 'updated_at', 'created_at'], 'integer'],
            [['count'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'master_id' => 'Master ID',
            'count' => 'Count',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
