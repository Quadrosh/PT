<?php

namespace common\models;

use Yii;

/**
 * This is the search model class for model "master".
 *

 */
class MasterSearch extends \yii\elasticsearch\ActiveRecord
{
    public static function index() {
        return 'psihotera';
    }

    public static function type() {
        return 'master';
    }



    /**
     * @inheritdoc
     */
    public function attributes()
    {
        return [
            'id',
            'username',
            'hrurl',
            'name',
            'middlename',
            'surname',
            'image',
            'image_alt',
            'city',
            'phone',
            'other_contacts',
            'address',
            'email',
            'site_link',
            'site_id',
            'comment',
            'background_image',
            'stylekey',
            'hello',
            'view',
            'layout',
            'list_add',
            'status',
            'created_at',
            'updated_at',
            'psys',
            'tags',
            'mtexts',
            'sessions',

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
                    'username' => ['type' => 'string'],
                    'hrurl' => ['type' => 'string'],
                    'name' => ['type' => 'string'],
                    'middlename' => ['type' => 'string'],
                    'surname' => ['type' => 'string'],
                    'city' => ['type' => 'string'],
                    'phone' => ['type' => 'string'],
                    'other_contacts'  => ['type' => 'string'],
                    'site_link' => ['type' => 'string'],
                    'address' => ['type' => 'string'],
                    'site_id' => ['type' => 'long'],
                    'hello'  => ['type' => 'string'],
                    'list_add' => ['type' => 'string'],
                    'status' => ['type' => 'string'],
                    'psys' => ['type' => 'string'],
                    'created_at' => ['type' => 'long'],
                    'updated_at' => ['type' => 'long'],
                    'tags' => ['type' => 'string'],
                    'mtexts' => ['type' => 'string'],
                    'sessions' => ['type' => 'string'],


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
}
