<?php

namespace backend\controllers;

use common\models\UploadForm;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Yii;
use common\models\Imagefiles;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\imagine\Image;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ImagefilesController implements the CRUD actions for Imagefiles model.
 */
class ImagefilesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Imagefiles models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $uploadmodel = new UploadForm();
        $dataProvider = new ActiveDataProvider([
            'query' => Imagefiles::find(),
            'pagination'=> [
                'pageSize' => 100,
            ],
            'sort' =>[
                'defaultOrder'=> [
                    'id' => SORT_DESC
                ]
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'uploadmodel' => $uploadmodel,
        ]);
    }

    /**
     * Displays a single Imagefiles model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Url::remember();
        $uploadmodel = new UploadForm();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'uploadmodel' => $uploadmodel,
        ]);
    }

    /**
     * Creates a new Imagefiles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Imagefiles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Imagefiles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Imagefiles model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if(!$model['cloudname']){
            if(file_exists(Yii::$app->basePath.'/web/img/'.$model->name)){
                if(!unlink(Yii::$app->basePath.'/web/img/'.$model->name)) {
                    Yii::$app->session->setFlash('error', 'неполучается удалить файл');
                }
            }
            if(!$model->delete()) {
                Yii::$app->session->setFlash('error', 'неполучается удалить запись');
            }
        } else {
            if (\Cloudinary\Uploader::destroy($model->cloudname)) {
                if(!$model->delete()) {
                    Yii::$app->session->setFlash('error', 'неполучается удалить запись из базы');
                }
            } else {
                Yii::$app->session->setFlash('error', 'неполучается удалить запись из облака');
            }
        }
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the Imagefiles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Imagefiles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Imagefiles::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /**
     * Change existing image file for QuotepadImg model with same file name
     */
    public function actionChange()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            $data=Yii::$app->request->post('UploadForm');
            $model = Imagefiles::find()->where(['id'=>$data['toModelId']])->one();
            if ($uploadmodel->change($model->name)) {

                Yii::$app->session->addFlash('success', 'Файл обновлен успешно');
            } else {
                Yii::$app->session->addFlash('error', 'Что то пошло не так');
            }
            return $this->redirect(Url::previous());
        }
    }
    /**
     * Upload images
     */
    public function actionUpload()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            if ($uploadmodel->upload()) {
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');
            }
            return $this->redirect(Url::previous());
        }
    }

    public function actionCloud()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            $fileName = $uploadmodel->imageFile->baseName.'.'.$uploadmodel->imageFile->extension;
            if ($uploadmodel->uploadtmp()) {
                $cloud = \Cloudinary\Uploader::upload(Yii::getAlias('@webroot/img/tmp-'. $fileName));
                $imageListItem = new Imagefiles();
                $imageListItem['name'] = $fileName;
                $imageListItem['cloudname'] = $cloud['public_id'];
                if($imageListItem->save()){
                    unlink(Yii::getAlias('@webroot/img/tmp-' . $fileName));
                    Yii::$app->session->setFlash('success', 'Файл загружен успешно');
                    return $this->redirect(Url::previous());
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения');
                }
            }
        }

    }


//    public function actionThumbnail($image)
//    {
//        Image::thumbnail('@webroot/img/'.$image,200,200)
//            ->save(Yii::getAlias('@webroot/img/th-'.$image),['quality'=>100]);
//        return $this->redirect(Url::previous());
//    }

    public function actionThumbMaster($image,$place)
    {
        $imagine = new \Imagine\Imagick\Imagine();
        $imageWork = $imagine->open(Yii::getAlias('@webroot/img/'.$image));
        $size = $imageWork->getSize();
        $width = $size->getWidth();
        $height = $size->getHeight();
//        $sizeAvatar = 180;
        $sizeAvatar = 168;
        $k=1.072;

        if($height>=$width){
            if ($place == 'top') {
                $imageWork->resize(new Box($sizeAvatar, $height / ($width / $sizeAvatar)))
                    ->crop(new Point(0, 0), new Box($sizeAvatar, round($sizeAvatar*$k)))
                    ->save(Yii::getAlias('@webroot/img/th-' . $image));
            }
            if($place == 'center'){
                $imageWork->resize(new Box($sizeAvatar,$height/($width/$sizeAvatar)))
                    ->crop(new Point(0,(($height/($width/$sizeAvatar)-round($sizeAvatar*$k))/2)), new Box($sizeAvatar,round($sizeAvatar*$k)))
                    ->save(Yii::getAlias('@webroot/img/th-'.$image));
            }
            if($place == 'bottom'){
                $imageWork->resize(new Box($sizeAvatar,$height/($width/$sizeAvatar)))
                    ->crop(new Point(0,($height/($width/$sizeAvatar)-round($sizeAvatar*$k))), new Box($sizeAvatar,round($sizeAvatar*$k)))
                    ->save(Yii::getAlias('@webroot/img/th-'.$image));
            }

        } else {
            $imageWork->resize(new Box($width/($height/$sizeAvatar),$sizeAvatar))
                ->crop(new Point(0,0), new Box($sizeAvatar,$sizeAvatar))
                ->save(Yii::getAlias('@webroot/img/th-'.$image));
        }


        return $this->redirect(Url::previous());
    }


    public function actionThumbMasterList($image,$place)
    {
        $imagine = new \Imagine\Imagick\Imagine();
        $imageWork = $imagine->open(Yii::getAlias('@webroot/img/'.$image));
        $size = $imageWork->getSize();
        $width = $size->getWidth();
        $height = $size->getHeight();
        $sizeAvatar = 120;

        if ($height >= $width) {
            if($place == 'top') {
                $imageWork->resize(new Box($sizeAvatar, $height / ($width / $sizeAvatar)))
                    ->crop(new Point(0, 0), new Box($sizeAvatar, $sizeAvatar))
                    ->save(Yii::getAlias('@webroot/img/th-list-' . $image));
            }
            if($place == 'center') {
                $imageWork->resize(new Box($sizeAvatar, $height / ($width / $sizeAvatar)))
                    ->crop(new Point(0, (($height/($width/$sizeAvatar)-$sizeAvatar)/2)), new Box($sizeAvatar, $sizeAvatar))
                    ->save(Yii::getAlias('@webroot/img/th-list-' . $image));
            }
            if($place == 'bottom') {
                $imageWork->resize(new Box($sizeAvatar, $height / ($width / $sizeAvatar)))
                    ->crop(new Point(0, ($height/($width/$sizeAvatar)-$sizeAvatar)), new Box($sizeAvatar, $sizeAvatar))
                    ->save(Yii::getAlias('@webroot/img/th-list-' . $image));
            }
        } else {
            $imageWork->resize(new Box($width / ($height / $sizeAvatar), $sizeAvatar))
                ->crop(new Point(0, 0), new Box($sizeAvatar, $sizeAvatar))
                ->save(Yii::getAlias('@webroot/img/th-list-' . $image));
        }

        return $this->redirect(Url::previous());
    }

    public function actionThumbArticleList($image,$place)
    {
        \Tinify\setKey("jTlTDnTRucf5k1bK87U_VVEUTTDtTnxe");
        $imagine = new \Imagine\Imagick\Imagine();
        $imageWork = $imagine->open(Yii::getAlias('@webroot/img/'.$image));
        $imageWorkMedium = $imagine->open(Yii::getAlias('@webroot/img/'.$image));
        $imageWorkBig = $imagine->open(Yii::getAlias('@webroot/img/'.$image));
        $size = $imageWork->getSize();
        $width = $size->getWidth();
        $height = $size->getHeight();
        $sizeAvatar = 120;
        $sizeAvatarMedium = 240; //240 x 319
        $sizeAvatarBig = 480; //480 x 638
        $k=1.33;

        if ($height >= $width) {
        } else {  // $width > $height
            if($place == 'leftTop') {
                $imageWork->resize(new Box(round($width / ($height / $sizeAvatar)), $sizeAvatar))
                    ->crop(new Point(0, 0), new Box(round($sizeAvatar*$k), $sizeAvatar))
                    ->save(Yii::getAlias('@webroot/img/th-list-source-' . $image));
                $imageWorkMedium->resize(new Box(round($width / ($height / $sizeAvatarMedium)), $sizeAvatarMedium))
                    ->crop(new Point(0, 0), new Box(round($sizeAvatarMedium*$k), $sizeAvatarMedium))
                    ->save(Yii::getAlias('@webroot/img/th-medium-source-' . $image));
                $imageWorkBig->resize(new Box(round($width / ($height / $sizeAvatarBig)), $sizeAvatarBig))
                    ->crop(new Point(0, 0), new Box(round($sizeAvatarBig*$k), $sizeAvatarBig))
                    ->save(Yii::getAlias('@webroot/img/th-big-source-' . $image));
            }
            if($place == 'rightTop') {
                $imageWork->resize(new Box(round($width / ($height / $sizeAvatar)), $sizeAvatar))
                    ->crop(new Point(round($width / ($height / $sizeAvatar))-round($sizeAvatar*$k), 0), new Box(round($sizeAvatar*$k), $sizeAvatar))
                    ->save(Yii::getAlias('@webroot/img/th-list-source-' . $image));
                $imageWorkMedium->resize(new Box(round($width / ($height / $sizeAvatarMedium)), $sizeAvatarMedium))
                    ->crop(new Point(round($width / ($height / $sizeAvatarMedium))-round($sizeAvatarMedium*$k), 0), new Box(round($sizeAvatarMedium*$k), $sizeAvatarMedium))
                    ->save(Yii::getAlias('@webroot/img/th-medium-source-' . $image));
                $imageWorkBig->resize(new Box(round($width / ($height / $sizeAvatarBig)), $sizeAvatarBig))
                    ->crop(new Point(round($width / ($height / $sizeAvatarBig))-round($sizeAvatarBig*$k), 0), new Box(round($sizeAvatarBig*$k), $sizeAvatarBig))
                    ->save(Yii::getAlias('@webroot/img/th-big-source-' . $image));
            }
            if($place == 'centerTop') {
                $imageWork->resize(new Box(round($width / ($height / $sizeAvatar)), $sizeAvatar))
                    ->crop(new Point((round($width / ($height / $sizeAvatar))-round($sizeAvatar*$k))/2, 0), new Box(round($sizeAvatar*$k), $sizeAvatar))
                    ->save(Yii::getAlias('@webroot/img/th-list-source-' . $image));
                $imageWorkMedium->resize(new Box(round($width / ($height / $sizeAvatarMedium)), $sizeAvatarMedium))
                    ->crop(new Point((round($width / ($height / $sizeAvatarMedium))-round($sizeAvatarMedium*$k))/2, 0), new Box(round($sizeAvatarMedium*$k), $sizeAvatarMedium))
                    ->save(Yii::getAlias('@webroot/img/th-medium-source-' . $image));
                $imageWorkBig->resize(new Box(round($width / ($height / $sizeAvatarBig)), $sizeAvatarBig))
                    ->crop(new Point((round($width / ($height / $sizeAvatarBig))-round($sizeAvatarBig*$k))/2, 0), new Box(round($sizeAvatarBig*$k), $sizeAvatarBig))
                    ->save(Yii::getAlias('@webroot/img/th-big-source-' . $image));
            }
            $tinify = \Tinify\fromFile(Yii::getAlias('@webroot/img/th-list-source-' . $image));
            $tinify->toFile(Yii::getAlias('@webroot/img/th-list-' . $image));
            $tinify = \Tinify\fromFile(Yii::getAlias('@webroot/img/th-medium-source-' . $image));
            $tinify->toFile(Yii::getAlias('@webroot/img/th-medium-' . $image));
            $tinify = \Tinify\fromFile(Yii::getAlias('@webroot/img/th-big-source-' . $image));
            $tinify->toFile(Yii::getAlias('@webroot/img/th-big-' . $image));
            unlink(Yii::getAlias('@webroot/img/th-list-source-' . $image));
            unlink(Yii::getAlias('@webroot/img/th-medium-source-' . $image));
            unlink(Yii::getAlias('@webroot/img/th-big-source-' . $image));

        }

        return $this->redirect(Url::previous());
    }






    public function actionDownloadFromCloud($id)
    {
       $oImg = Imagefiles::findOne($id);
//       $url = 'https://'.
//           Yii::$app->params['cloudinary']['api_key'].':'.
//           Yii::$app->params['cloudinary']['api_secret'].'@api.cloudinary.com/v1_1/'.
//           Yii::$app->params['cloudinary']['cloud_name'].'/resources/image';

       $url = 'https://res.cloudinary.com/'.
           Yii::$app->params['cloudinary']['cloud_name'].
           '/image/upload/'.
           $oImg->cloudname;


        Yii::$app->session->addFlash('success', $url);

        $saveto = Yii::getAlias('@webroot/img/' . $oImg->name);

       $this->grabImage($url,$saveto);

        Yii::$app->session->addFlash('success', $saveto);

        return $this->redirect(Url::previous());
    }

    private function grabImage($url,$saveto){
        $ch = curl_init ($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
        $raw=curl_exec($ch);
        curl_close ($ch);
        if(file_exists($saveto)){
            unlink($saveto);
        }
        error_reporting(E_ALL ^ E_WARNING);
        $fp = fopen($saveto,'x');
        fwrite($fp, $raw);
        fclose($fp);
    }

}



//Квадрат и прямоугольник  GA
//200 x 200	Малый квадрат
//240 x 400	Вертикальный прямоугольник
//250 x 250	Квадрат
//250 x 360	Тройное широкоэкранное объявление
//300 x 250	Встраиваемый прямоугольник
//336 x 280	Большой прямоугольник
//580 x 400	Netboard

//1,25:1 (5:4)
//1,33:1 (4:3)    18×24
//1,5:1 (3:2)

