<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "psychotherapy_item".
 *
 * @property integer $id
 * @property string $name
 */
class PsychotherapyItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'psychotherapy_item';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'unique'],
            [['name','hrurl'], 'string', 'max' => 255],
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
            'hrurl' => 'hrurl',
        ];
    }
    /**
     * Статьи
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(),['id'=>'article_id'])
            ->viaTable('item_assign',['item_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'psy']);
            });
    }

    /**
     * Мастера
     */
    public function getMasters()
    {
        return $this->hasMany(Master::className(),['id'=>'master_id'])
            ->viaTable('item_assign',['item_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'psy']);
            });
    }

}
