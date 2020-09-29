<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "master_service".
 *
 * @property int $id
 * @property int|null $master_id
 * @property string|null $name
 * @property string|null $value
 * @property string|null $comment
 * @property int|null $sort
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class MasterService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'master_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['master_id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['name', 'value', 'comment'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'name' => 'Name',
            'value' => 'Value',
            'comment' => 'Comment',
            'sort' => 'Sort',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            $master = $this->master;

            if ($this->isNewRecord) {
                if (!$this->sort ) {
                    if ($master && $master->services) {
                        $this->sort = count($master->services)+1;
                    } else {
                        $this->sort = 1;
                    }
                }
            }
            return true;
        }
        return false;
    }


    public static function moveUpBySort($id)
    {
        $model = self::findOne($id);

        $siblings = self::find()->where([
            'master_id'=>$model->master_id
        ])->orderBy(['sort'=>SORT_ASC])->all();


        if (count($siblings)>1) {
            foreach ($siblings as $key => $child) {
                if ($child['id'] == $id && $key > 0) {
                    $item = $child;
                    $siblings[$key] = $siblings[$key-1];
                    $siblings[$key-1] = $item;
                }
            }
            foreach ($siblings as $key => $child) {
                $child->sort = $key+1;
                $child->save();
            }
        }
    }

    public static function moveDownBySort($id)
    {
        $model = self::findOne($id);

        $siblings = self::find()->where([
            'master_id'=>$model->master_id
        ])->orderBy(['sort'=>SORT_ASC])->all();


        if (count($siblings)>1) {
            foreach ($siblings as $key => $child) {
                if ($child['id'] == $id && $key < count($siblings)-1) {
                    $item = $child;
                    $siblings[$key] = $siblings[$key+1];
                    $siblings[$key+1] = $item;
                }
            }
            foreach ($siblings as $key => $child) {
                $child->sort = $key+1;
                $child->save();
            }
        }
    }

    public function getMaster()
    {
        return $this->hasOne(Master::class,['id'=>'master_id']);
    }
}
