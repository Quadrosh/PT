<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "quote".
 *
 * @property integer $id
 * @property integer $list_num
 * @property string $text
 * @property string $addition
 * @property string $author
 * @property integer $master_id
 * @property string $status
 */
class Quote extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quote';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['list_num', 'master_id'], 'integer'],
            [['text'], 'required'],
            [['text', 'addition'], 'string'],
            [['author', 'status','image'], 'string', 'max' => 255],
            [['image_alt'], 'string', 'max' => 510],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'list_num' => 'List Num',
            'text' => 'Text',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'addition' => 'Addition',
            'author' => 'Author',
            'master_id' => 'Master ID',
            'status' => 'Status',
        ];
    }
    /**
     * image cloud
     */
    public function getImagefile()
    {
        return $this->hasOne(Imagefiles::className(),['name'=>'image']);
    }
}
