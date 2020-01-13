<?php

namespace backend\controllers;

use common\models\Imagefiles;
use common\models\UploadForm;
use Yii;
use common\models\ArticleSection;
use common\models\ArticleSectionSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleSectionController implements the CRUD actions for ArticleSection model.
 */
class ArticleSectionController extends BackController
{


    /**
     * Lists all ArticleSection models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();
        $searchModel = new ArticleSectionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ArticleSection model.
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
     * Creates a new ArticleSection model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($article_id=null)
    {
        $model = new ArticleSection();
        $model->article_id=$article_id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ArticleSection model.
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
     * Deletes an existing ArticleSection model.
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
     * Finds the ArticleSection model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ArticleSection the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ArticleSection::findOne($id)) !== null) {
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
            $model = ArticleSection::find()->where(['id'=>$data['toModelId']])->one();

            if ($model->$toModelProperty) {
                $image = Imagefiles::findOne(['name'=>$model->$toModelProperty]);
                if ($image) {
                    $image->delete();
                }
            }

            $fileName = 'articlesection'.$model->id.$toModelProperty;

            if ($uploadmodel->uploadAndSetName($fileName)) {

                $model->$toModelProperty = $fileName . '.' . $uploadmodel->imageFile->extension;
                $model->save();
                Yii::$app->session->setFlash('success', 'Файл загружен успешно');
            } else {
                Yii::$app->session->setFlash('error', 'не получается загрузить изображение в секцию '.json_encode($uploadmodel->errors));
            }
            return $this->redirect(Url::previous());
        }
    }

    public function actionDeleteImage($id,$propertyName)
    {
        $this->findModel($id)->deleteImage($propertyName);
        return $this->redirect(Url::previous());
    }


    public function actionMoveUp($id)
    {
        ArticleSection::moveUpBySort($id);

        return $this->redirect(Url::previous());
    }

    public function actionMoveDown($id)
    {
        ArticleSection::moveDownBySort($id);

        return $this->redirect(Url::previous());
    }
}
