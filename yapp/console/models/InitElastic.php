<?php

namespace console\models;
use Yii;

class InitElastic extends \yii\elasticsearch\ActiveRecord
{
    public static function index() {
        return 'psihotera';
    }

    public static function type() {
        return 'init';
    }

    public function attributes()
    {
        return ['name'];
    }
//    public function rules()
//    {
//        return [
//            ['name', 'required']
//        ];
//    }
}