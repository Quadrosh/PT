<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\BtnItem;
use common\models\CityItem;
use common\models\DailyCount;
use common\models\ItemAssign;
use common\models\Master;
use common\models\MasterpageItem;
use common\models\MasterSearch;
use common\models\ProfessionItem;
use common\models\PsychotherapyItem;
use common\models\SiteItem;
use common\models\Tag;
use common\models\Visit;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\db\Query;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class MasterController extends Controller
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
                'pageSize' => 100,
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

    /**
     * filter.
     * @return mixed
     */
    public function actionFilter()
    {
        $this->layout = 'index_nopadding';
        $this->view->params['title'] = 'Психотера - все о психотерапии - Статьи';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';
        $current =[];
        $current['headLine']='';

        if (Yii::$app->request->isPost) {
            $data = Yii::$app->request->post('FilterForm');

            $current['city'] = $data['city'];
            $current['tag'] = $data['tag'];
            $current['psy'] = $data['psy'];
            $current['pro'] = $data['pro'];
            $current['session'] = $data['session'];

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
            $sessionQ = $data['session']
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


    public function actionSearch()
    {
        Url::remember();
        $this->layout = 'index_nopadding';
        $this->view->params['title'] = 'Психотера - все о психотерапии - Статьи';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';
        $current = [];
        $current['headLine'] = '';

        $request = Yii::$app->request->post('SearchForm');
        $search = $request['search'];

        $current['search'] = $search;
        $this->view->params['search'] = $search;
        $rows = MasterSearch::find()->query(['multi_match'=>['query'=>$search,'fields'=>[
            'username',
            'name',
            'middlename',
            'surname',
            'hrurl',
            'other_contacts',
            'hello',
            'phone',
            'address',
            'city',
            'psys',
            'tags',
            'mtexts',
            'sessions',
            'list_add',

        ]]])->all();
        $masters=[];
        foreach ($rows as $row) {
            $master = Master::find()->where(['id'=>$row['id']])->one();
            $masters[] = $master;
        }

        $DataProvider = new ArrayDataProvider([
            'allModels'=>$masters,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('search', [
            'dataProvider' => $DataProvider,
        ]);
    }


    public function actionView($hrurl)
    {

        $this->layout = 'master';
        Url::remember();
        $this->getUtm();
        $master = Master::find()->where(['hrurl'=>$hrurl])->one();

        // счетчик просмотров за день
        $now = time();
        $todayStart = $now - ($now % 86400);
        $todayCount = DailyCount::find()
            ->where(['master_id'=>$master['id']])
            ->andWhere('created_at > '.$todayStart)
            ->one();
        if (!$todayCount) {
            $todayCount = new DailyCount;
            $todayCount['count'] = 1;
            $todayCount['master_id'] = $master['id'];
        } else {
            $todayCount['count'] += 1;
        }
        $todayCount->save();



        $masterData=[];
        $masterData['professions'] = $master->pros;
        $masterData['psys'] = $master->psys;
        $masterData['sites'] = $master->sites;

        $masterPages = Article::find()->where(['master_id'=>$master['id'],'link2original'=>'masterpage','status'=>'publish'])->all();
        $this->view->params['background_image'] = $master->backgroundImagefile['cloudname'];

        $article = null;
        if(Yii::$app->request->get('article')){
            $articleHrurl = Yii::$app->request->get('article');
            $article = Article::find()->where(['hrurl'=>$articleHrurl])->one();
            if ($articleHrurl == 'go' ) {
                $article = $articleHrurl;
                if(Yii::$app->request->isPjax){
                    return $this->render('order',[
                        'article'=>$article,
                    ]);
                }
            } elseif ($articleHrurl == 'otziv') {
                $article = $articleHrurl;
                if(Yii::$app->request->isPjax){
                    return $this->render('reviews',[
                        'article'=>$article,
                    ]);
                }
            } else {
                if(Yii::$app->request->isPjax){
                    return $this->render('read',[
                        'article'=>$article,
                    ]);
                }
            }
        }
        $proCount = 1;
        $pros2title = '';
        foreach ($masterData['professions'] as $profession){
            if ($proCount != count($masterData['professions'])) {
                $pros2title .= $profession['name'].', ';
            } else {
                $pros2title .= $profession['name'];
            }
            $proCount++;
        }
        $this->view->params['meta']['title'] = $master['username'].' - '.$pros2title;
        $this->view->params['meta']['description']='';
        return $this->render('view', [
            'master' => $master,
            'masterPages' => $masterPages,
            'masterData' => $masterData,
            'article' => $article,

        ]);
    }







    public function actionReviews($hrurl)
    {
        Url::remember();
        $master = Master::find()->where(['hrurl'=>$hrurl]);
        return $this->render('reviews', [
            'master' => $master,
        ]);
    }

    public function actionOrder($hrurl)
    {
        Url::remember();
        $master = Master::find()->where(['hrurl'=>$hrurl]);
        return $this->render('order', [
            'master' => $master,
        ]);
    }




    public function actionRead()
    {
        $hrurl = Yii::$app->request->get('article');
        $this->layout = 'none';

        $article = Article::find()->where(['hrurl'=>$hrurl])->one();

//        var_dump($article); die;

        return $this->render('read',[
            'article'=>$article,
        ]);
    }



    public function getUtm()
    {
        $utm = [];
        $session = Yii::$app->session;

        if (Yii::$app->request->get('utm_source')) {
            // UTM из GET
            $utm['source'] = Yii::$app->request->get('utm_source');
            $utm['medium'] = Yii::$app->request->get('utm_medium');
            $utm['campaign'] = Yii::$app->request->get('utm_campaign');
            $utm['term'] = Yii::$app->request->get('utm_term');
            $utm['content'] = Yii::$app->request->get('utm_content');

            // сохранение в сессию
            if (Yii::$app->request->get('utm_source')!= null) {
                $session['utm_source'] = $utm['source'];
                $session['utm_medium'] = $utm['medium'];
                $session['utm_campaign'] = $utm['campaign'];
                $session['utm_term'] = $utm['term'];
                $session['utm_content'] = $utm['content'];
            }
        } else {
            if ($session['utm_source']) {
                $utm['source'] = $session['utm_source'];
                $utm['medium'] = $session['utm_medium'];
                $utm['campaign'] = $session['utm_campaign'];
                $utm['term'] = $session['utm_term'];
                $utm['content'] = $session['utm_content'];
            } else { // если там что то есть
                $utm['source'] = Yii::$app->request->get('utm_source');
                $utm['medium'] = Yii::$app->request->get('utm_medium');
                $utm['campaign'] = Yii::$app->request->get('utm_campaign');
                $utm['term'] = Yii::$app->request->get('utm_term');
                $utm['content'] = Yii::$app->request->get('utm_content');
            }
        }

        //сохр визита в статистику
        $visit = new Visit();
        $visit['ip'] = Yii::$app->request->userIP;
        $visit['site'] = 'PT';
        $visit['lp_hrurl'] = '';
        $visit['url'] = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
        $visit['utm_source']=$utm['source'];
        $visit['utm_medium']=$utm['medium'];
        $visit['utm_campaign']=$utm['campaign'];
        $visit['utm_term']=$utm['term'];
        $visit['utm_content']=$utm['content'];
        $visit['qnt']=1;
        $visit->save();

        return $utm;

    }


}
