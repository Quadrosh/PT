<?php

namespace common\models;

use backend\controllers\ImagefilesController;
use yii\base\Action;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;
use common\models\Imagefiles;

class TextForm  extends Model
{
    /**
     * @var $text string
     */
    public $text;


    public function rules()
    {
        return [
            [['text'], 'required',],
            [['text'], 'string'],
        ];
    }



}