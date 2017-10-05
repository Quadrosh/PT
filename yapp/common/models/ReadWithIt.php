<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "read_with_it".
 *
 * @property integer $id
 * @property integer $article_id
 * @property integer $master_id
 * @property string $m_ids
 * @property string $a_ids
 * @property integer $updated_at
 * @property integer $created_at
 */
class ReadWithIt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'read_with_it';
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
            [['article_id', 'master_id', 'updated_at', 'created_at'], 'integer'],
            [['m_ids', 'a_ids'], 'string', 'max' => 510],
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
            'm_ids' => 'M Ids',
            'a_ids' => 'A Ids',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
