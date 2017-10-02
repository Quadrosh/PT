<?php

namespace backend\controllers;

use common\models\ItemAssign;
use common\models\Master;
use Yii;
use common\models\SiteItem;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SiteitemController implements the CRUD actions for SiteItem model.
 */
class SiteitemController extends Controller
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
     * Lists all SiteItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => SiteItem::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SiteItem model.
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
     * Creates a new SiteItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SiteItem();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatejax()
    {
        $model = new SiteItem();
        $model['name'] = Yii::$app->request->post('name');
        $model['link'] = Yii::$app->request->post('link');
        $masterId = Yii::$app->request->post('master_id');
        $modelM = Master::find()->where(['id'=>$masterId])->one();
        $itemAssign = new ItemAssign();

//        if ( $model->save()) {
//            return $this->render('createjax', [
//                'itemAssign' => $itemAssign,
//                'model'=>$modelM
//            ]);
//        } else {
//            echo 'FaLsE from Siteitem -> Createjax';
//        }
        $model->save();
//        $this->layout = 'none';
        return $this->render('createjax', [
            'itemAssign' => $itemAssign,
            'model'=>$modelM
        ]);




//        else {
//            return $this->render('createjax', [
//                'model' => $model,
//            ]);
//        }
    }

    /**
     * Updates an existing SiteItem model.
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
     * Deletes an existing SiteItem model.
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
     * Finds the SiteItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SiteItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SiteItem::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
