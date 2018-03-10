<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "article_pic".
 *
 * @property int $id
 * @property int $article_id
 * @property int $imagefile_id
 * @property string $sort
 * @property string $image_alt
 * @property string $code
 * @property int $created_at
 */
class ArticlePic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_pic';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => false,
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'imagefile_id', 'created_at'], 'integer'],
            [['code'], 'string'],
            [['sort', 'image_alt'], 'string', 'max' => 255],
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
            'imagefile_id' => 'Imagefile ID',
            'sort' => 'Sort',
            'image_alt' => 'Image Alt',
            'code' => 'Code',
            'created_at' => 'Created At',
        ];
    }
}
