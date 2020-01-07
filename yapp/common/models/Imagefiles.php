<?php

namespace common\models;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\imagine\Image;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "imagefiles".
 *
 * @property int $id
 * @property string $name
 */
class Imagefiles extends \yii\db\ActiveRecord
{

    const TERM_CUT_OVERFLOW = 'cutoverflow_';
    const TERM_SAVE_OVERFLOW = 'saveoverflow_';
    const SIZE_200_200 = '200x200_';
    const SIZE_WIDTH_300_HEIGHT_AUTO = '300x0_';
    const SIZE_WIDTH_600_HEIGHT_AUTO = '600x0_';
    const SIZE_560_360 = '560x360_';
    const SIZE_360_270 = '360x270_';
    const SIZE_240_240 = '240x240_';
    const SIZE_690_480 = '690x480_';


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'imagefiles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 524],
            [['cloudname'], 'string', 'max' => 255],
            [['name'], 'unique',  'message' => 'Файл "{value}" уже существует, измени имя загружаемого файла или назначь существующий'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'cloudname' => 'Cloudname',
        ];
    }
    public function addNew($name)
    {
        $this->name = $name;
        if ($this->validate()) {
            if ($this->save()) {
                return true;
            } else {
                Yii::$app->session->setFlash('error', 'Ошибка сохранения imagefile');
                return false;
            }
        } else {
            Yii::$app->session->setFlash('error', 'Ошибка валидации - '.$this->errors['name'][0]);
            return false;
        }
    }




    public static function constructImage($name){

        $resourcesPath = \Yii::getAlias('@webroot').'/img/view/'.$name;

        if (preg_match('/(\d+)x(\d+)_.*\.(jpg|jpeg|png|gif)/i', $resourcesPath, $matches)) {

            if (!isset($matches[0]) || !isset($matches[1]) || !isset($matches[2]) || !isset($matches[3])){
                throw new BadRequestHttpException('Некорректный запрос.');
            }

            Yii::error(['$matches'=>$matches]);

// высота и ширина из названия
            $width = $matches[1];
            $height = $matches[2];

            $cutVarsFromFilename = str_replace($width.'x'.$height.'_', '', $resourcesPath);
// overflow
            $cutOverflow = null;
            $addOverflow = null;
            if (strpos($name,Imagefiles::TERM_CUT_OVERFLOW)!==false) {
                $cutOverflow = true;
                $cutVarsFromFilename = str_replace(Imagefiles::TERM_CUT_OVERFLOW, '', $cutVarsFromFilename);
            }
            else if (strpos($name,Imagefiles::TERM_SAVE_OVERFLOW)!==false) {
                $addOverflow = true;
                $cutVarsFromFilename = str_replace(Imagefiles::TERM_SAVE_OVERFLOW, '', $cutVarsFromFilename);
            }

            $originalFile = str_replace('view/', '', $cutVarsFromFilename);

            if (!file_exists($originalFile)) {
                throw new NotFoundHttpException('Страница не найдена. Not found original');
            }

            try {
                $origImg =Image::getImagine()->open( $originalFile);
            } catch (\Imagine\Exception\Exception $e) {
                throw new BadRequestHttpException('изображение повреждено или неправильного формата');
            }

            // dirty fix bug of horizontal big images
            $origData = $origImg->getSize();
            $origW = $origData->getWidth();
            $autoRotate =  \yii\imagine\Image::autorotate($origImg);
            $autoRotateData = $autoRotate->getSize();
            $autoRotateW = $autoRotateData->getWidth();
            if ($origW != $autoRotateW) {
                unlink($originalFile);
                $autoRotate->save($originalFile);
            }



            if ($width == 0 || $height == 0 ) {


                $origImg = Image::getImagine()->open( $originalFile);
                $origData = $origImg->getSize();
                $origWidth = $origData->getWidth();
                $origHeight = $origData->getHeight();
                $ratio = $origWidth/$origHeight;

                if ($width == 0) {
                    $width = round($height*$ratio);

                }
                if ($height == 0){
                    $height=round($width/$ratio);
                };
            }

            Yii::error(['$width'=>$width,'$height'=>$height]);
//            $origImg = \yii\imagine\Image::getImagine()->open(Yii::getAlias($webRoot.'/img/'.$filenameOrig));


            $dirname = dirname($resourcesPath);
            if (!is_dir($dirname)) mkdir($dirname, 0775, true);

            if ($addOverflow) {
                Image::thumbnail( $originalFile , $width, $height, ManipulatorInterface::THUMBNAIL_INSET)
                    ->save( $resourcesPath, ['quality' => 85]);
            } else {
                if ($matches[1] == $matches[2]) {
                    Image::thumbnail( $originalFile , $width, $height, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                        ->save( $resourcesPath, ['quality' => 85]);
                } else {
                    if ($cutOverflow) {
                        Image::thumbnail( $originalFile , $width, $height, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                            ->save( $resourcesPath, ['quality' => 85]);
                    } else {
                        Image::thumbnail( $originalFile , $width, $height, ManipulatorInterface::THUMBNAIL_INSET)
                            ->save( $resourcesPath, ['quality' => 85]);
                    }
                }
            }

           return true;
        }
    }



    public function beforeDelete()
    {
        if (file_exists(Yii::getAlias('@app/web/img/').$this->name)) {
            static::removeFileAndGeneratedDimensions($this->name);
        }
        return true;
    }


    public static function removeFileAndGeneratedDimensions($name){
        $arr =  explode('.',$name);
        $nameWithoutExtension = $arr[0];
        $files=\yii\helpers\FileHelper::findFiles('img/view',['only'=>['*'.$nameWithoutExtension.'*']]);

        if ($files && isset($files[0])) {
            foreach ($files as $file) {
                unlink( Yii::$app->basePath.'/web/'.$file);
            }
        }
        unlink(Yii::$app->basePath.'/web/img/'.$name);
    }


}
