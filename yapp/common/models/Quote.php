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
            [['author', 'status'], 'string', 'max' => 255],
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
            'addition' => 'Addition',
            'author' => 'Author',
            'master_id' => 'Master ID',
            'status' => 'Status',
        ];
    }
}
