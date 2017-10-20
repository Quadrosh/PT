<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class FilterForm extends Model
{
    public $city;
    public $psy;
    public $pro;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city', 'psy', 'pro'], 'string'],
        ];
    }




//    /**
//     * Finds user by [[username]]
//     *
//     * @return User|null
//     */
//    protected function getUser()
//    {
//        if ($this->_user === null) {
//            $this->_user = User::findByUsername($this->username);
//        }
//
//        return $this->_user;
//    }
}
