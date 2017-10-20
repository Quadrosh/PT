<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "city_item".
 *
 * @property int $id
 * @property string $name
 * @property string $hrurl
 */
class CityItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'hrurl'], 'string', 'max' => 255],
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
        ];
    }
    /**
     * Статьи
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(),['id'=>'article_id'])
            ->viaTable('item_assign',['item_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'city']);
            });
    }

    /**
     * Мастера
     */
    public function getMasters()
    {
        return $this->hasMany(Master::className(),['id'=>'master_id'])
            ->viaTable('item_assign',['item_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'city']);
            });
    }
}
