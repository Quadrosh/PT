<?php
namespace common\components;


use Yii;
use yii\base\Component;

class Helpers extends Component
{

    public function value2KeyValue($array)
    {
        $newArr=[];
        foreach ($array as $item) {
            $newArr[$item]=$item;
        }
        return $newArr;
    }

}