<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "lt_feel".
 *
 * @property int $id
 * @property string $hrurl
 * @property int $order_num
 * @property int $price
 * @property string $name
 * @property string $description
 * @property string $level
 * @property string $duration
 * @property int $cat_id
 * @property string $warning
 * @property string $thanx
 * @property string $text
 * @property string $status
 * @property int $master_id
 * @property string $author
 * @property string $author_about
 * @property int $created_at
 * @property int $updated_at
 */
class LtFeel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lt_feel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_num', 'price', 'cat_id', 'master_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'description', 'warning', 'thanx', 'text', 'author', 'author_about'], 'string'],
            [['description', 'level'], 'required'],
            [['hrurl', 'level', 'duration', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hrurl' => 'Hrurl',
            'order_num' => 'Order Num',
            'price' => 'Price',
            'name' => 'Name',
            'description' => 'Description',
            'level' => 'Level',
            'duration' => 'Duration',
            'cat_id' => 'Cat ID',
            'warning' => 'Warning',
            'thanx' => 'Thanx',
            'text' => 'Text',
            'status' => 'Status',
            'master_id' => 'Master ID',
            'author' => 'Author',
            'author_about' => 'Author About',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
