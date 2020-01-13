<?php

namespace backend\controllers;

use common\models\ArticleSearch;
use common\models\Imagefiles;
use common\models\ItemAssign;
use common\models\PsychotherapyItem;
use common\models\SiteItem;
use common\models\Tag;
use common\models\Tagassign;
use common\models\UploadForm;
//use console\models\ArticleElastic;
use Yii;
use common\models\Article;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionMasterTexts($master_id)
    {
        Url::remember();
            $dataProvider = new ActiveDataProvider([
                'query' => Article::find()
                    ->where(['master_id'=>$master_id])
                    ->andWhere(['link2original'=>'masterpage'])
                    ->orderBy('list_num'),
                'pagination'=> [
                    'pageSize' => 100,
                ],
                'sort' =>[
                    'defaultOrder'=> [
                        'id' => SORT_DESC
                    ]
                ]
            ]);
        return $this->render('master_text_index', [
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        Url::remember();

        $dataProvider = new ActiveDataProvider([
            'query' => Article::find(),
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
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        Url::remember();
        $uploadmodel = new UploadForm();
        $itemAssign = new ItemAssign();
        $tagAssign = new Tagassign();
        $psyData = ItemAssign::find()->where(['item_type'=>'psy','article_id'=>$id])->all();
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

        $siteData = ItemAssign::find()->where(['item_type'=>'site','article_id'=>$id])->all();
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

        $tagsData = Tagassign::find()->where(['article_id'=>$id])->all();
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

        return $this->render('view', [
            'model' => $this->findModel($id),
            'tagAssign' => $tagAssign,
            'tags' => $tags,
            'itemAssign' => $itemAssign,
            'psyAssigns' => $psyAssigns,
            'siteAssigns' => $siteAssigns,
            'uploadmodel' => $uploadmodel,
        ]);
    }

    /**
     * Displays a single MasterText.
     * @param integer $id
     * @return mixed
     */
    public function actionViewMasterText($id)
    {
        Url::remember();
        $uploadmodel = new UploadForm();
        $itemAssign = new ItemAssign();
        $tagAssign = new Tagassign();
        $psyData = ItemAssign::find()->where(['item_type'=>'psy','article_id'=>$id])->all();
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

        $siteData = ItemAssign::find()->where(['item_type'=>'site','article_id'=>$id])->all();
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

        $tagsData = Tagassign::find()->where(['article_id'=>$id])->all();
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

        return $this->render('view_master_text', [
            'model' => $this->findModel($id),
            'tagAssign' => $tagAssign,
            'tags' => $tags,
            'itemAssign' => $itemAssign,
            'psyAssigns' => $psyAssigns,
            'siteAssigns' => $siteAssigns,
            'uploadmodel' => $uploadmodel,
        ]);
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
            $model = Article::find()->where(['id'=>$data['toModelId']])->one();
            if ($uploadmodel->upload()) {
                $model->$toModelProperty = $uploadmodel->imageFile->baseName . '.' . $uploadmodel->imageFile->extension;
                $model->save();
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
            $data=Yii::$app->request->post('UploadForm');
            $toModelProperty = $data['toModelProperty'];
            $model = Article::find()->where(['id'=>$data['toModelId']])->one();
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

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionMtextcreate()
    {
        $model = new Article();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Url::previous());
        } else {
            return $this->render('create_master_text', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Article model.
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
//    public function actionTranslit()
//    {
//        $article = Article::find()->where(['id'=>Yii::$app->request->get('id')])->one();
//        $article['hrurl'] = Article::cyrillicToLatin(Yii::$app->request->get('text'), 210, true);
//        $article->save();
//        return $this->redirect(Url::previous());
//    }

    public function actionSave($id)
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
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSearchIndex($id)
    {
        $source = Article::find()->where(['id'=>$id])->one();
        $searchItem = ArticleSearch::find()->where(['id'=>$id])->one();
        if (!$searchItem) {
        $searchItem = new ArticleSearch();
        $searchItem->setPrimaryKey($id);
        }
//        $searchItem->attributes = $source->attributes;
        $searchItem['id'] = $source['id'];
        $searchItem['list_name'] = $source['list_name'];
        $searchItem['hrurl'] = $source['hrurl'];
        $searchItem['pagehead'] = $source['pagehead'];
        $searchItem['text'] = $source['text'];
        $searchItem['excerpt'] = $source['excerpt'];
        $searchItem['excerpt_big'] = $source['excerpt_big'];
        $searchItem['author'] = $source['author'];
        if ($source['status'] != 'publish') {
            Yii::$app->session->setFlash('error', 'индексация невозможна, объект не в стадии публикации');
            return $this->redirect(Url::previous());
        }

        if ($searchItem->save()) {
            Yii::$app->session->setFlash('success', 'объект проиндексирован для поиска');
        } else {
            Yii::$app->session->setFlash('error', 'индексирование не получилось');
        };
        return $this->redirect(Url::previous());
    }

    public function actionChangeSubStr($id)
    {
        $model = Article::findOne($id);
        $form = Yii::$app->request->post('FromToForm');
        $newText = str_replace($form['from'], $form['to'], $model['text']);
        $model['text'] = $newText;
        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'текст обновлен');
        } else {
            Yii::$app->session->setFlash('error', 'не получилось');
        };
        return $this->redirect(Url::previous());
    }


    /**
     * Upload images with autofill corresponding model property
     */
    public function actionUploadImage()
    {
        $uploadmodel = new UploadForm();
        if (Yii::$app->request->isPost) {
            $uploadmodel->imageFile = UploadedFile::getInstance($uploadmodel, 'imageFile');
            $data=Yii::$app->request->post('UploadForm');
            $toModelProperty = $data['toModelProperty'];

            $article = Article::find()->where(['id'=>$data['toModelId']])->one();
            if ($article->$toModelProperty) {
                $image = Imagefiles::findOne(['name'=>$article->$toModelProperty]);
                if ($image) {
                    $image->delete();
                }

            }

            $filename = 'article'.$article->id.''.$toModelProperty;

            if ($uploadmodel->uploadAndSetName($filename)) {
                $article->$toModelProperty = $filename . '.' . $uploadmodel->imageFile->extension;
                $article->save();
                Yii::$app->session->addFlash('success', 'Файл загружен успешно');
            } else {
                Yii::$app->session->addFlash('error', 'Ошибка загрузки файла');
            }
            return $this->redirect(Url::previous());
        }
    }

}
