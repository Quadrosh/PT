<?php

namespace backend\controllers;

use common\models\Imagefiles;
use common\models\UploadForm;
use Yii;
use common\models\ArticleSectionBlockItem;
use common\models\ArticleSectionBlockItemSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleSectionBlockItemController implements the CRUD actions for ArticleSectionBlockItem model.
 */
class ArticleSectionBlockItemController extends BackController
{


    /**
     * Lists all ArticleSectionBlockItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new ArticleSectionBlockItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleSectionBlockItem model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Url::remember();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ArticleSectionBlockItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($block_id = null)
    {
        $model = new ArticleSectionBlockItem();
        $model->article_section_block_id = $block_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleSectionBlockItem model.
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
     * Deletes an existing ArticleSectionBlockItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Url::previous());
    }

    /**
     * Finds the ArticleSectionBlockItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleSectionBlockItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleSectionBlockItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Upload images for  model with autofill corresponding model property
     */
    public function actionUpload()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            $data=Yii::$app->request->post('UploadForm');
            $toModelProperty = $data['toModelProperty'];
            $model = ArticleSectionBlockItem::find()->where(['id'=>$data['toModelId']])->one();
            if ($model->$toModelProperty) {
                $image = Imagefiles::findOne(['name'=>$model->$toModelProperty]);
                if ($image) {
                    $image->delete();
                }
            }
            $fileName = 'articlesectionblockitem'.$model->id.$toModelProperty;
            if ($uploadmodel->uploadAndSetName($fileName)) {

                $model->$toModelProperty = $fileName . '.' . $uploadmodel->imageFile->extension;
                $model->save();
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');
            } else {
                Yii::$app->session->setFlash('error', 'не получается');
            }
            return $this->redirect(Url::previous());
        }
    }

    public function actionDeleteImage($id,$propertyName)
    {
        $this->findModel($id)->deleteImage($propertyName);
        return $this->redirect(Url::previous());
    }


    public function actionMultiply($id,$qnt)
    {
        $this->findModel($id)->multiply($qnt);
        return $this->redirect(Url::previous());
    }
}
