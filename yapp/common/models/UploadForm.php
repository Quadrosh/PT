<?php

namespace common\models;

use backend\controllers\ImagefilesController;
use common\models\Imagefiles;
use yii\base\Action;
use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $toModelId;
    public $toModelProperty;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg, svg'],
        ];
    }

    public function upload($add1=false,$add2=false)
    {
        $imageRecord = new Imagefiles();

        $name = str_replace([' ','.',',','-'],'_',$this->imageFile->baseName);

        if ($this->validate() && $imageRecord->addNew($add1 . $name . $add2.'.' . $this->imageFile->extension)) {
            if ($this->imageFile->saveAs('img/' . $add1 . $name . $add2 .'.' . $this->imageFile->extension)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function uploadAndSetName($name)
    {
        $imageRecord = new Imagefiles();

        $name = str_replace([' ','.',',','-'],'_', $name);
        $name = strtolower($name);

        if ($this->validate() && $imageRecord->addNew( $name .'.' . $this->imageFile->extension)) {
            if ($this->imageFile->saveAs('img/'. $name  .'.' . $this->imageFile->extension)) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function uploadtmp()
    {
        if ($this->validate()) {
            if ($this->imageFile->saveAs('img/tmp-' . $this->imageFile->baseName . '.' . $this->imageFile->extension)) {
                return true;
            } else {
                return false;
            }
        }
    }


    public function change($filename)
    {
        if ($this->validate()) {
            if ($this->imageFile->saveAs(Yii::$app->basePath . '/web/img/' . $filename)) {
                return true;
            } else {
                return false;
            }
        }
    }





}