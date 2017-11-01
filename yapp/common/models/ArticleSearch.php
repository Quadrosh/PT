<?php

namespace common\models;

use Yii;

/**
 * This is the search model for model "article".
 *
 */
class ArticleSearch extends \yii\elasticsearch\ActiveRecord
{
    public static function index() {
        return 'psihotera';
    }

    public static function type() {
        return 'article';
    }


    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [

            'id',
            'list_name',
            'hrurl',
            'title',
            'description',
            'keywords',
            'pagehead',
            'text',
            'excerpt',
            'excerpt_big',
            'author',
            'master_id',
            'status',
            'psys',
            'tags',
            'sites',
        ];
    }

    /**
     * @return array This model's mapping for elastic search
     */
    public static function mapping()
    {
        return [
            static::type() => [
                'properties' => [
                    'id' => ['type' => 'long'],
                    'list_name' => ['type' => 'string'],
                    'hrurl' => ['type' => 'string'],
                    'title' => ['type' => 'string'],
                    'description' => ['type' => 'string'],
                    'keywords' => ['type' => 'string'],
                    'pagehead' => ['type' => 'string'],
                    'text' => ['type' => 'string'],
                    'excerpt'  => ['type' => 'string'],
                    'excerpt_big' => ['type' => 'string'],
                    'author' => ['type' => 'string'],
                    'master_id' => ['type' => 'string'],
                    'status'  => ['type' => 'string'],
                    'psys'  => ['type' => 'string'],
                    'tags'  => ['type' => 'string'],
                    'sites'  => ['type' => 'string'],
                ]
            ],
        ];
    }


    /**
     * Set (update) mappings for this model
     */
    public static function updateMapping()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->setMapping(static::index(), static::type(), static::mapping());
    }

    /**
     * Create this model's index
     */
    public static function createIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->createIndex(static::index(), [
            'settings' => [ /* ... */ ],
            'mappings' => static::mapping(),
            //'warmers' => [ /* ... */ ],
            //'aliases' => [ /* ... */ ],
            //'creation_date' => '...'
        ]);
    }

    /**
     * Delete this model's index
     */
    public static function deleteIndex()
    {
        $db = static::getDb();
        $command = $db->createCommand();
        $command->deleteIndex(static::index(), static::type());
    }


    /**
     * мастер
     */
    public function getMaster()
    {
        return $this->hasOne(Master::className(),['id'=>'master_id']);
    }

    /**
     * Статья
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(),['id'=>'id']);
    }


}
