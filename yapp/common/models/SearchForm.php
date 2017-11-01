<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Filter form
 */
class SearchForm extends Model
{
    public $search;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'search',
            ], 'string'],
        ];
    }




}
