<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag_assign".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property integer $article_id
 * @property integer $master_id
 */
class Tagassign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag_assign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id'], 'required'],
            [['tag_id', 'article_id', 'master_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_id' => 'Tag ID',
            'article_id' => 'Article ID',
            'master_id' => 'Master ID',
        ];
    }
}
