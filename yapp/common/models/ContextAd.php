<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "context_ad".
 *
 * @property int $id
 * @property int $host
 * @property int $master_id
 * @property string $id_on_host
 * @property string|null $type
 * @property string|null $name
 * @property int|null $daily_limit
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class ContextAd extends \yii\db\ActiveRecord
{

    const STATUS_ACTIVE = 100;
    const STATUS_NOT_ACTIVE = 101;

    const HOST_YANDEX = 100;
    const HOST_GOOGLE = 101;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%context_ad}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['host', 'master_id', 'id_on_host'], 'required'],
            [['host', 'master_id', 'daily_limit', 'status', 'created_at', 'updated_at'], 'integer'],
            [['id_on_host', 'type', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'host' => 'Host',
            'master_id' => 'Master ID',
            'id_on_host' => 'Id On Host',
            'type' => 'Type',
            'name' => 'Name',
            'daily_limit' => 'Daily Limit',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
