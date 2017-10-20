<?php

namespace backend\controllers;

use common\models\Article;
use common\models\Master;
use common\models\SiteItem;
use Yii;
use common\models\ItemAssign;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ItemassignController implements the CRUD actions for ItemAssign model.
 */
class ItemassignController extends Controller
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
        $itemAssignModel = new ItemAssign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('ItemAssign');
            $itemAssignModel['item_type'] = $data['item_type'];
            $itemAssignModel['item_id'] = $data['item_id'];
            $itemAssignModel['article_id'] = $data['article_id'];
            $itemAssignModel['master_id'] = $data['master_id'];


            $itemAssignModel->save();

            return $this->redirect(Url::previous());
        }


    }


    public function actionAssignCityXx()
    {
        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');

        $itemAssignModel = new ItemAssign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('ItemAssign');
//            var_dump($data); die;
            $itemAssignModel['item_type'] = $data['item_type'];
            $itemAssignModel['item_id'] = $data['item_id'];
            $itemAssignModel['article_id'] = $data['article_id'];
            $itemAssignModel['master_id'] = $data['master_id'];
            $itemAssignModel->save();

            return $this->render('assign_city_xx',[
                'type'=>$type,
                'id'=>$id,
                'articleId'=>$data['article_id'],
                'masterId'=>$data['master_id'],
            ]);
        }
    }

    public function actionAssignproxx()
    {
        $itemAssignModel = new ItemAssign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('ItemAssign');
            $itemAssignModel['item_type'] = $data['item_type'];
            $itemAssignModel['item_id'] = $data['item_id'];
            $itemAssignModel['article_id'] = $data['article_id'];
            $itemAssignModel['master_id'] = $data['master_id'];
            $model = Master::find()->where(['id'=>$data['master_id']])->one();

            $itemAssignModel->save();


            return $this->render('assign_pro_xx',[
                'model'=>$model
            ]);

        }


    }

    public function actionAssignpsyxx()
    {
        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');

        $itemAssignModel = new ItemAssign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('ItemAssign');
            $itemAssignModel['item_type'] = $data['item_type'];
            $itemAssignModel['item_id'] = $data['item_id'];
            $itemAssignModel['article_id'] = $data['article_id'];
            $itemAssignModel['master_id'] = $data['master_id'];
            $itemAssignModel->save();

            return $this->render('assign_psy_xx',[
                'type'=>$type,
                'id'=>$id,
                'articleId'=>$data['article_id'],
                'masterId'=>$data['master_id'],
            ]);
        }
    }

    public function actionAssignsitexx()
    {
        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');

        $itemAssignModel = new ItemAssign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('ItemAssign');
            $itemAssignModel['item_type'] = $data['item_type'];
            $itemAssignModel['item_id'] = $data['item_id'];
            $itemAssignModel['article_id'] = $data['article_id'];
            $itemAssignModel['master_id'] = $data['master_id'];
            $itemAssignModel->save();

            return $this->render('assign_site_xx',[
                'type'=>$type,
                'id'=>$id,
                'articleId'=>$data['article_id'],
                'masterId'=>$data['master_id'],
            ]);
        }
    }

    public function actionAssignmpagexx()
    {
        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');

        $itemAssignModel = new ItemAssign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('ItemAssign');
            $itemAssignModel['item_type'] = $data['item_type'];
            $itemAssignModel['item_id'] = $data['item_id'];
            $itemAssignModel['article_id'] = $data['article_id'];
            $itemAssignModel['master_id'] = $data['master_id'];
            $itemAssignModel->save();

            return $this->render('assign_masterpage_xx',[
                'type'=>$type,
                'id'=>$id,
                'articleId'=>$data['article_id'],
                'masterId'=>$data['master_id'],
            ]);
        }
    }

    public function actionAssignbtnxx()
    {
        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');

        $itemAssignModel = new ItemAssign();
        if (Yii::$app->request->isPost) {
            $data=Yii::$app->request->post('ItemAssign');
            $itemAssignModel['item_type'] = $data['item_type'];
            $itemAssignModel['item_id'] = $data['item_id'];
            $itemAssignModel['article_id'] = $data['article_id'];
            $itemAssignModel['master_id'] = $data['master_id'];
            $itemAssignModel->save();

            return $this->render('assign_btn_xx',[
                'type'=>$type,
                'id'=>$id,
                'articleId'=>$data['article_id'],
                'masterId'=>$data['master_id'],
            ]);
        }
    }




    public function actionAssignjax()
    {
        $itemAssign = new ItemAssign();
        $itemAssignModel = new ItemAssign();

        $data = Yii::$app->request->post('ItemAssign');
        $itemAssignModel['item_type'] = $data['item_type'];
        $itemAssignModel['item_id'] = $data['item_id'];
        $itemAssignModel['article_id'] = $data['article_id'];
        $itemAssignModel['master_id'] = $data['master_id'];

        $model = Master::find()->where(['id'=>$data['master_id']])->one();



        $siteData = ItemAssign::find()->where(['item_type'=>'site','master_id'=>$data['master_id']])->all();
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

        if ( $itemAssignModel->save()) {
            return $this->render('assignjax',[
                'itemAssign'=>$itemAssign,
                'itemAssignModel'=>$itemAssignModel,
                'siteAssigns'=>$siteAssigns,
                'model'=>$model
            ]);
        }

        return $this->render('assignjax',[
            'itemAssign'=>$itemAssign,
            'siteAssigns'=>$siteAssigns,
            'model'=>$model
        ]);


    }
    /**
     * Lists all ItemAssign models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ItemAssign::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ItemAssign model.
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
     * Creates a new ItemAssign model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemAssign();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ItemAssign model.
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
     * Deletes an existing ItemAssign model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(Url::previous());
    }

    public function actionDeletexx($id)
    {
        $this->findModel($id)->delete();
        if (!Yii::$app->request->isPjax) {
//        if (!Yii::$app->request->isAjax) {
            return $this->redirect(Url::previous());
        }
    }


    /**
     * Finds the ItemAssign model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemAssign the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemAssign::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
