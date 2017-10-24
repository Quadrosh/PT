<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Filter form
 */
class FilterForm extends Model
{
    public $city;
    public $psy;
    public $pro;
    public $tag;
    public $session;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'city',
                'tag',
                'psy',
                'session',
                'pro'
            ], 'string'],
        ];
    }




}
