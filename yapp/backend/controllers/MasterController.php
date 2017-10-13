<?php

namespace backend\controllers;

use common\models\Imagefiles;
use common\models\ItemAssign;
use common\models\ProfessionItem;
use common\models\PsychotherapyItem;
use common\models\SiteItem;
use common\models\Tag;
use common\models\Tagassign;
use common\models\UploadForm;
use Yii;
use common\models\Master;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * MasterController implements the CRUD actions for Master model.
 */
class MasterController extends Controller
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
     * Lists all Master models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $dataProvider = new ActiveDataProvider([
            'query' => Master::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Master model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Url::remember();
        $uploadmodel = new UploadForm();
        $tagAssign = new Tagassign();
        $itemAssign = new ItemAssign();


        $psyData = ItemAssign::find()->where(['item_type'=>'psy','master_id'=>$id])->all();
        $psyTypes = PsychotherapyItem::find()->all();
        $psyAssigns = [];
        $psyIter = 0;
        foreach ($psyData as $psyItem) {
            $psyAssigns[$psyIter]['id']=$psyItem['id'];
            foreach ($psyTypes as $psyType) {
                if($psyType['id'] == $psyItem['item_id']){
                    $psyAssigns[$psyIter]['name'] = $psyType['name'];
                }
            }
            $psyIter++;
        }

        $siteData = ItemAssign::find()->where(['item_type'=>'site','master_id'=>$id])->all();
        $siteTypes = SiteItem::find()->all();
        $siteAssigns = [];
        $siteIter = 0;
        foreach ($siteData as $siteItem) {
            $siteAssigns[$siteIter]['id']=$siteItem['id'];
            foreach ($siteTypes as $siteType) {
                if($siteType['id'] == $siteItem['item_id']){
                    $siteAssigns[$siteIter]['name'] = $siteType['name'];
                    $siteAssigns[$siteIter]['link'] = $siteType['link'];
                }
            }
            $siteIter++;
        }


        $tagsData = Tagassign::find()->where(['master_id'=>$id])->all();
        $tags = [];
        $tagIter = 0;
        foreach ($tagsData as $tag) {
            $tags[$tagIter]['id'] = $tag['id'];
            $tags[$tagIter]['tag_id'] = $tag['tag_id'];
            $tags[$tagIter]['name'] = Tag::find()->where(['id'=>$tag['tag_id']])->one()->name;
            $tags[$tagIter]['article_id'] = $tag['article_id'];
            $tags[$tagIter]['master_id'] = $tag['master_id'];

            $tagIter++;
        }


        $request = Yii::$app->request->post('ItemAssign');

        if(Yii::$app->request->isPjax){

            if(Yii::$app->request->post('Tagassign')){
                $tagAssignModel = new Tagassign();
                $tagAssignModel->attributes = Yii::$app->request->post('Tagassign');
                $tagAssignModel->save();

                $tagsData = Tagassign::find()->where(['master_id'=>$id])->all();
                $tags = [];
                $tagIter = 0;
                foreach ($tagsData as $tag) {
                    $tags[$tagIter]['id'] = $tag['id'];
                    $tags[$tagIter]['tag_id'] = $tag['tag_id'];
                    $tags[$tagIter]['name'] = Tag::find()->where(['id'=>$tag['tag_id']])->one()->name;
                    $tags[$tagIter]['article_id'] = $tag['article_id'];
                    $tags[$tagIter]['master_id'] = $tag['master_id'];

                    $tagIter++;
                }
                return $this->render('view_tagassign', [
                    'model' => $this->findModel($id),
                    '$tags' => $tags,
                    '$tagAssign' => $tagAssign,
                ]);
            }
            if($request && $request['item_type'] = 'site') {
                $itemAssignModel = new ItemAssign();
                $itemAssignModel->attributes = Yii::$app->request->post('ItemAssign');
                $itemAssignModel->save();

                $siteData = ItemAssign::find()->where(['item_type'=>'site','master_id'=>$id])->all();
                $siteAssigns = [];
                $siteIter = 0;
                foreach ($siteData as $siteItem) {
                    $siteAssigns[$siteIter]['id']=$siteItem['id'];
                    foreach ($siteTypes as $siteType) {
                        if($siteType['id'] == $siteItem['item_id']){
                            $siteAssigns[$siteIter]['name'] = $siteType['name'];
                            $siteAssigns[$siteIter]['link'] = $siteType['link'];
                        }
                    }
                    $siteIter++;
                }

                return $this->render('view_siteassign', [
                'model' => $this->findModel($id),
                'itemAssign' => $itemAssign,
                'siteAssigns' => $siteAssigns,
                ]);
            }


        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'tagAssign' => $tagAssign,
                'tags' => $tags,
                'itemAssign' => $itemAssign,
                'psyAssigns' => $psyAssigns,
//                'proAssigns' => $proAssigns,
                'siteAssigns' => $siteAssigns,
                'uploadmodel' => $uploadmodel,
            ]);
        }




    }


    /**
     * Upload images with autofill corresponding model property
     */
    public function actionUpload()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            $data=Yii::$app->request->post('UploadForm');
            $toModelProperty = $data['toModelProperty'];
            $model = Master::find()->where(['id'=>$data['toModelId']])->one();
            if ($uploadmodel->upload()) {
                $model->$toModelProperty = $uploadmodel->imageFile->baseName . '.' . $uploadmodel->imageFile->extension;
                $model->save();
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');
            }
            return $this->redirect(Url::previous());
        }
    }
    /**
     * Creates a new Master model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Master();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Master model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Master model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Master model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Master the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Master::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Creates a cloud image
     *
     * @return mixed
     */
    public function actionCloud()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            $data=Yii::$app->request->post('UploadForm');
            $toModelProperty = $data['toModelProperty'];
            $model = Master::find()->where(['id'=>$data['toModelId']])->one();
            $fileName = $uploadmodel->imageFile->baseName.'.'.$uploadmodel->imageFile->extension;
            if ($uploadmodel->uploadtmp()) {
                $cloud = \Cloudinary\Uploader::upload(Yii::getAlias('@webroot/img/tmp-'. $fileName));
                $imageListItem = new Imagefiles();
                $imageListItem['name'] = $fileName;
                $imageListItem['cloudname'] = $cloud['public_id'];
                $model->$toModelProperty = $uploadmodel->imageFile->baseName . '.' . $uploadmodel->imageFile->extension;
                $model->save();
                if($imageListItem->save()){
                    unlink(Yii::getAlias('@webroot/img/tmp-' . $fileName));
                    Yii::$app->session->setFlash('success', 'Файл загружен успешно');
                } else {
                    Yii::$app->session->setFlash('error', 'Ошибка сохранения');
                }
            }
            return $this->redirect(Url::previous());
        }

    }
}
