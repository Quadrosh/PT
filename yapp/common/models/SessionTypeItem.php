<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "session_type_item".
 *
 * @property int $id
 * @property string $name
 * @property string $hrurl
 *
 */


class SessionTypeItem extends \yii\db\ActiveRecord
{
    public $value;
    public $comment;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'session_type_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'hrurl'], 'string', 'max' => 255],
            [['value', 'comment'], 'safe'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'hrurl' => 'Hrurl',
            'value' => 'value',
            'comment' => 'comment',
        ];
    }
}
