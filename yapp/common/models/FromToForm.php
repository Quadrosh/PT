<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Filter form
 */
class FromToForm extends Model
{
    public $from;
    public $to;



    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'from',
                'to',
            ], 'string'],
        ];
    }




}
