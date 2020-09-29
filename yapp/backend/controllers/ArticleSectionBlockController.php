<?php

namespace backend\controllers;

use common\models\Imagefiles;
use common\models\UploadForm;
use Yii;
use common\models\ArticleSectionBlock;
use common\models\ArticleSectionBlockSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleSectionBlockController implements the CRUD actions for ArticleSectionBlock model.
 */
class ArticleSectionBlockController extends BackController
{


    /**
     * Lists all ArticleSectionBlock models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new ArticleSectionBlockSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleSectionBlock model.
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
     * Creates a new ArticleSectionBlock model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($section_id=null)
    {
        $model = new ArticleSectionBlock();
        $model->article_section_id=$section_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleSectionBlock model.
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
     * Deletes an existing ArticleSectionBlock model.
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
     * Finds the ArticleSectionBlock model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleSectionBlock the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleSectionBlock::findOne($id)) !== null) {
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
            $model = ArticleSectionBlock::find()->where(['id'=>$data['toModelId']])->one();

            if ($model->$toModelProperty) {
                $image = Imagefiles::findOne(['name'=>$model->$toModelProperty]);
                if ($image) {
                    $image->delete();
                }
            }

            $fileName = 'articlesectionblock'.$model->id.$toModelProperty;

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

    public function actionRawTextToItems($id,$mode = 1)
    {
        $block = ArticleSectionBlock::find()->where(['id'=>$id])->one();

        if ($block->rawTextToItems($mode)) {
            return $this->redirect(Url::previous());
        }
    }


    /*
    * Перемещение вверх по сортировке
    * */
    public function actionMoveUp($id)
    {
        ArticleSectionBlock::moveUpBySort($id);
        return $this->redirect(Url::previous());
    }


    /*
     * Перемещение вниз по сортировке
     * */
    public function actionMoveDown($id)
    {
        ArticleSectionBlock::moveDownBySort($id);
        return $this->redirect(Url::previous());
    }
}
