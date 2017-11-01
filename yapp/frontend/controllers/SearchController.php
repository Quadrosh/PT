<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\Master;

use Yii;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\web\Controller;


/**
 * Site controller
 */
class SearchController extends Controller
{


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ]

        ];
    }

    /**
     * index.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'index_nopadding';
        $this->view->params['title'] = 'Психотера - все о психотерапии - Статьи';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';
        $current =[];
        $current['headLine']='';

        $search = Yii::$app->request->post('SearchForm');

        var_dump($search);


        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('FilterForm');

            $current['city']=$data['city'];
            $current['tag']=$data['tag'];
            $current['psy']=$data['psy'];
            $current['pro']=$data['pro'];
            $current['session']=$data['session'];

            $cityQ = $data['city']
                ? (new Query())
                ->from('item_assign')
                ->where(['item_id'=>$data['city'],'item_type'=>'city'])
                ->select('master_id')
                : (new Query())->from('master')->select('id');
            $tagQ = $data['tag']
                ? (new Query())
                ->from('tag_assign')
                ->where(['tag_id'=>$data['tag']])
                ->select('master_id')
                : (new Query())->from('master')->select('id');
            $psyQ = $data['psy']
                ? (new Query())
                ->from('item_assign')
                ->where(['item_id'=>$data['psy'],'item_type'=>'psy'])
                ->select('master_id')
                : (new Query())->from('master')->select('id');
            $proQ = $data['pro']
                ? (new Query())
                ->from('item_assign')
                ->where(['item_id'=>$data['pro'],'item_type'=>'pro'])
                ->select('master_id')
                : (new Query())->from('master')->select('id');
            $sessionQ = $data['pro']
                ? (new Query())
                ->from('item_assign')
                ->where(['item_id'=>$data['session'],'item_type'=>'session'])
                ->select('master_id')
                : (new Query())->from('master')->select('id');

            $mastersQ = Master::find()
                ->where(['id' => $cityQ])
                ->andWhere(['id' => $tagQ])
                ->andWhere(['id' => $psyQ])
                ->andWhere(['id' => $proQ])
                ->andWhere(['id' => $sessionQ])
                ->all();



        } else {
            $mastersQ = Master::find()->with('pros', 'psys', 'sites', 'btns')->limit(100)->all();

        }

        $masterDataProvider = new ArrayDataProvider([
            'allModels'=>$mastersQ,
            'pagination' => [
                'pageSize' => 10,
            ],
//            'sort' => [
//                'attributes' => ['id', 'username'],
//            ],
        ]);



        return $this->render('index', [
            'dataProvider' => $masterDataProvider,
            'current' => $current,
        ]);
    }




}
