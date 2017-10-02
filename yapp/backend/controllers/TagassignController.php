<?php

namespace backend\controllers;

use common\models\Tag;
use Yii;
use common\models\Tagassign;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TagassignController implements the CRUD actions for Tagassign model.
 */
class TagassignController extends Controller
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

    public function actionAssign()
    {
        $tagAssignModel = new Tagassign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('Tagassign');
            $tagAssignModel['tag_id'] = $data['tag_id'];
            $tagAssignModel['article_id'] = $data['article_id'];
            $tagAssignModel['master_id'] = $data['master_id'];

            $tagAssignModel->save();

            return $this->redirect(Url::previous());
        }


    }

    public function actionDeletexx($id)
    {
        $this->findModel($id)->delete();
        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Url::previous());
        }
    }

    public function actionAssignxx()
    {
        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');

        $tagAssignModel = new Tagassign();
        $request = Yii::$app->request->post('Tagassign');
        $tagAssignModel['tag_id'] = $request['tag_id'];
        $tagAssignModel['article_id'] = $request['article_id'];
        $tagAssignModel['master_id'] = $request['master_id'];
        $tagAssignModel->save();

        $articleId = $request['article_id'];
        $masterId  = $request['master_id'];

        if ($type == 'master') {
            $tagsData = Tagassign::find()->where(['master_id'=>$id])->all();
        }
        if ($type=='article') {
            $tagsData = Tagassign::find()->where(['article_id'=>$id])->all();
        }

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
        $tagAssign = new Tagassign();
        return $this->render('assignxx', [
            'type'=>$type,
            'id'=>$id,
            'articleId'=>$articleId,
            'masterId'=>$masterId,

            'tags' => $tags,
            'tagAssign' => $tagAssign,
        ]);
    }

    /**
     * Lists all Tagassign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Tagassign::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tagassign model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tagassign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tagassign();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tagassign model.
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
     * Deletes an existing Tagassign model.
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
     * Finds the Tagassign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tagassign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tagassign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
