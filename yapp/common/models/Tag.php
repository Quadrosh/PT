<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
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
            ->viaTable('tag_assign',['tag_id'=>'id']);
    }

    /**
     * Мастера
     */
    public function getMasters()
    {
        return $this->hasMany(Master::className(),['id'=>'master_id'])
            ->viaTable('tag_assign',['tag_id'=>'id']);
    }




    /**
     * метки из Article
     */
//    public function getTags()
//    {
//        return $this->hasMany(Tag::className(),['id'=>'tag_id'])
//            ->viaTable('tag_assign',['article_id'=>'id']);
//    }
}
