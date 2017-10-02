<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "site_item".
 *
 * @property integer $id
 * @property string $name
 * @property string $link
 */
class SiteItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'link'], 'required'],
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
            'name' => 'Name',
            'link' => 'Link',
        ];
    }
}
