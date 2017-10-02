<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "masterpage_item".
 *
 * @property integer $id
 * @property integer $master_id
 * @property string $name
 * @property string $link
 */
class MasterpageItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'masterpage_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['master_id', 'name', 'link'], 'required'],
            [['master_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 510],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'name' => 'Name',
            'link' => 'Link',
        ];
    }
}
