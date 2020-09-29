<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\ArticleSearch;
use common\models\DailyCount;
use common\models\Master;
use common\models\PsychotherapyItem;
use common\models\ReadWithIt;
use common\models\Tag;
use common\models\Visit;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ArrayDataProvider;
use yii\helpers\ArrayHelper;
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
use yii\elasticsearch\Query;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class ArticleController extends Controller
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
     * Displays index.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'article_index';
        $this->view->params['title'] = 'Психотера - все о психотерапии - Статьи';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';
//             ->andWhere('type != :value',['value'=>Article::TYPE_MASTER_PAGE])
//             ->andWhere('link2original != :value',['value'=>'masterpage'])
        $articles = Article::find()
            ->where(['type'=>Article::TYPE_ARTICLE,'status'=>'publish'])
            ->with('psys','sites','tags')
            ->limit(100)
            ->all();
        $articleDataProvider = new ArrayDataProvider([
            'allModels'=>$articles,
            'pagination' => [
                'pageSize' => 100,
            ],
//            'sort' => [
//                'attributes' => ['id', 'username'],
//            ],
        ]);


//        popular
        $query = Article::find()
            ->select(['article.*', 'SUM(daily_count.count) AS countviews'])
            ->where(['type'=>Article::TYPE_ARTICLE,'status'=>'publish'])
            ->join('LEFT JOIN', DailyCount::tableName(), 'article.id=daily_count.article_id')
            ->groupBy('article.id')
            ->orderBy(['countviews' => SORT_DESC])
            ->limit(6);


        $popularArticles = $query->all();

        $topArticle = Article::find()->where(['id'=>7])->one();
        return $this->render('index', [
            'dataProvider' => $articleDataProvider,
            'popularArticles' => $popularArticles,
            'topArticle' => $topArticle,
        ]);
    }

    public function actionView($hrurl)
    {
        Url::remember();
        $this->getUtm();
        $article = Article::find()->where([
            'hrurl'=>$hrurl,
            'type'=>Article::TYPE_ARTICLE,
            'status'=>Article::STATUS_PUBLISHED,
        ])->with('psys','sites','tags')->one();

        if (!$article) {
            throw new NotFoundHttpException('Страница не найдена или перемещена');
        }

        // счетчик просмотров
        $now = time();
        $todayStart = $now - ($now % 86400);
        $todayCount = DailyCount::find()
            ->where(['article_id'=>$article['id']])
            ->andWhere('created_at > '.$todayStart)
            ->one();
        if (!$todayCount) {
            $todayCount = new DailyCount;
            $todayCount['count'] = 1;
            $todayCount['article_id'] = $article['id'];
        } else {
            $todayCount['count'] += 1;
        }
        $todayCount->save();

        // с этим читают
        $session = Yii::$app->session;
        $articleRead = ['article_id'=>$article['id'],'time'=>$now];
        if ($session['articles']==null) {
            $session['articles']=[];
            $session['articles'] = array_merge($session['articles'], [$articleRead]);
        } else {
            $artIds='';
            foreach ($session['articles'] as $sessArt) {
                if ($sessArt['article_id']!=$article['id']) {
                    if ($sessArt['time']>= $now-3*3600) {
                        if ($artIds == null) {
                            $artIds = $artIds.$sessArt['article_id'];
                        } else {
                            $artIds = $artIds.','.$sessArt['article_id'];
                        }
                    }
                }
            }
            if ($artIds!=null) {
                $readWithIt = new ReadWithIt();
                $readWithIt['article_id'] = $article['id'];
                $readWithIt['a_ids'] = $artIds;
                $readWithIt->save();
                $session['articles'] = array_merge($session['articles'], [$articleRead]);
            }
        }


        $this->layout = 'article';
        $this->view->params['title'] = 'Психотера - '. $article['list_name'] .' ('.$article['author'].').';
        $this->view->params['description'] = $article['list_name'].' - '. $article['excerpt'];
        $this->view->params['keywords'] = 'психотерапия, психотерапевт'.$article['excerpt_big'];

        return $this->render('view', [
            'article' => $article,
        ]);
    }



    public function actionPage($hrurl)
    {
        Url::remember();
        $this->getUtm();
        $article = Article::find()->where([
            'hrurl'=>$hrurl,
            'type'=>Article::TYPE_PAGE,
            'status'=>Article::STATUS_PUBLISHED,
        ])->with('psys','sites','tags')->one();

        if (!$article) {
            throw new NotFoundHttpException('Страница не найдена или перемещена');
        }

        // счетчик просмотров
        $now = time();
        $todayStart = $now - ($now % 86400);
        $todayCount = DailyCount::find()
            ->where(['article_id'=>$article['id']])
            ->andWhere('created_at > '.$todayStart)
            ->one();
        if (!$todayCount) {
            $todayCount = new DailyCount;
            $todayCount['count'] = 1;
            $todayCount['article_id'] = $article['id'];
        } else {
            $todayCount['count'] += 1;
        }
        $todayCount->save();

        // с этим читают
        $session = Yii::$app->session;
        $articleRead = ['article_id'=>$article['id'],'time'=>$now];
        if ($session['articles']==null) {
            $session['articles']=[];
            $session['articles'] = array_merge($session['articles'], [$articleRead]);
        } else {
            $artIds='';
            foreach ($session['articles'] as $sessArt) {
                if ($sessArt['article_id']!=$article['id']) {
                    if ($sessArt['time']>= $now-3*3600) {
                        if ($artIds == null) {
                            $artIds = $artIds.$sessArt['article_id'];
                        } else {
                            $artIds = $artIds.','.$sessArt['article_id'];
                        }
                    }
                }
            }
            if ($artIds!=null) {
                $readWithIt = new ReadWithIt();
                $readWithIt['article_id'] = $article['id'];
                $readWithIt['a_ids'] = $artIds;
                $readWithIt->save();
                $session['articles'] = array_merge($session['articles'], [$articleRead]);
            }
        }


        $this->layout = $article->layout?$article->layout: 'article';

        $this->view->params['title'] = $article->title?$article->title:'Психотера - '. $article['list_name'] .' ('.$article['author'].').';
        $this->view->params['description'] = $article->description?$article->description: $article['list_name'].' - '. $article['excerpt'];
        $this->view->params['keywords'] = '-';

        $viewPath = '/article/view';

        if ($article->view) {
            $viewPath = '/article/part_views/article/'.$article->view;
        }
        return $this->render($viewPath, [
            'article' => $article,
        ]);


    }

    public function actionBytag($hrurl)
    {
        Url::remember();
//        $this->layout = 'article';
        $tag = Tag::find()->where(['hrurl'=>$hrurl])->one();
        $articles = $tag->articles;
        $this->view->params['title'] = 'Психотера - статьи - '. $tag['name'];
        $this->view->params['description'] = 'Психотера - статьи - '. $tag['name'];
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';

        $articleDataProvider = new ArrayDataProvider([
            'allModels'=>$articles,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $filterName = 'метке "'.$tag['name'].'"';
        return $this->render('filter', [
            'dataProvider' => $articleDataProvider,
            'filterName' => $filterName,
        ]);
    }

    public function actionBypsy($hrurl)
    {
        Url::remember();
//        $this->layout = 'article';
        $psy = PsychotherapyItem::find()->where(['hrurl'=>$hrurl])->one();
        $articles = $psy->articles;
        $this->view->params['title'] = 'Психотера - статьи - '. $psy['name'];
        $this->view->params['description'] = 'Психотера - статьи - '. $psy['name'];
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';

        $articleDataProvider = new ArrayDataProvider([
            'allModels'=>$articles,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        $filterName = 'виду "'.$psy['name'].'"';
        return $this->render('filter', [
            'dataProvider' => $articleDataProvider,
            'filterName' => $filterName,
        ]);
    }

    public function actionSearch()
    {
        Url::remember();
        $this->layout = 'article_index';
        $this->view->params['title'] = 'Психотера - все о психотерапии - Статьи';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';
        $current = [];
        $current['headLine'] = '';

        $request = Yii::$app->request->post('SearchForm');
        $search = $request['search'];
        $current['search'] = $search;
        $this->view->params['search'] = $search;
        $rows = ArticleSearch::find()->query(['multi_match'=>['query'=>$search,'fields'=>[
            'list_name',
            'hrurl',
            'pagehead',
            'text',
            'excerpt',
            'excerpt_big',
            'author',
            'psys',
            'tags',
            'sites',
            'master_id',

        ]]])->all();

        $articles=[];
        foreach ($rows as $row) {
            $article = Article::find()->where(['id'=>$row['id']])->one();
            $articles[] = $article;
        }

        $articleDataProvider = new ArrayDataProvider([
            'allModels'=>$articles,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('search', [
            'dataProvider' => $articleDataProvider,
        ]);
    }


    /**
     * Страница мастера
     *
     * @param string $hrurl
     * @throws BadRequestHttpException
     */
    public function actionPremiumMasterPage($root,$page=null)
    {
        Url::remember();
        $this->getUtm();

        if (
            $root !=  Master::HRURL_AIGUL_SHE &&
            $root !=  Master::HRURL_LYALINA
        ) {throw new BadRequestHttpException();}

        $master = Master::findOne(['hrurl'=> $root]);

        if ($page) {
            $article = Article::find()
                ->where([
                    'hrurl'=>$root.'/'.$page,
                    'object_type'=>Article::OBJECT_TYPE_MASTER,
                    'object_id'=>$master->id,
                ])
                ->with('psys','sites','tags')
                ->one();
        } else {
            $article = Article::find()
                ->where([
                    'hrurl'=>$root,
                    'object_type'=>Article::OBJECT_TYPE_MASTER,
                    'object_id'=>$master->id,
                ])
                ->with('psys','sites','tags')
                ->one();
        }





        if ($article->layout) {
            $this->layout = $article->layout;
        }
        // счетчик просмотров
        $now = time();
        $todayStart = $now - ($now % 86400);
        $todayCount = DailyCount::find()
            ->where(['article_id'=>$article['id']])
            ->andWhere('created_at > '.$todayStart)
            ->one();
        if (!$todayCount) {
            $todayCount = new DailyCount;
            $todayCount['count'] = 1;
            $todayCount['article_id'] = $article['id'];
        } else {
            $todayCount['count'] += 1;
        }
        $todayCount->save();

        $this->view->params['title'] = $article->title;
        $this->view->params['description'] = $article->description;
        $this->view->params['keywords'] = 'психотерапия, психотерапевт'.$article['excerpt_big'];

        return $this->render('common_view', [
            'model' => $article,
        ]);
    }

    /**
     * Страница мастера (старый алгоритм)
     *
     * @param string $hrurl

     */
    public function actionMasterPage($hrurl)
    {
        Url::remember();
        $this->getUtm();

        if ($hrurl ==  Master::HRURL_AIGUL_SHE ||
            substr($hrurl,0,3)== Master::HRURL_AIGUL_SHE) {
            $master = Master::findOne(['hrurl'=> Master::HRURL_AIGUL_SHE]);
            if ($hrurl ==  Master::HRURL_AIGUL_SHE) {
                $hrurl = 'home';
            } else {
                $nameParts = explode('/',$hrurl);
                $hrurl = $nameParts[1];
            }
            $article = Article::find()
                ->where([
                    'hrurl'=>$hrurl,
                    'object_type'=>Article::OBJECT_TYPE_MASTER,
                    'object_id'=>$master->id,
                ])
                ->with('psys','sites','tags')
                ->one();

        } else {



            throw new BadRequestHttpException();
        }

        if ($article->layout) {
            $this->layout = $article->layout;
        }
        // счетчик просмотров
        $now = time();
        $todayStart = $now - ($now % 86400);
        $todayCount = DailyCount::find()
            ->where(['article_id'=>$article['id']])
            ->andWhere('created_at > '.$todayStart)
            ->one();
        if (!$todayCount) {
            $todayCount = new DailyCount;
            $todayCount['count'] = 1;
            $todayCount['article_id'] = $article['id'];
        } else {
            $todayCount['count'] += 1;
        }
        $todayCount->save();

        $this->view->params['title'] = $article->title;
        $this->view->params['description'] = $article->description;
        $this->view->params['keywords'] = 'психотерапия, психотерапевт'.$article['excerpt_big'];

        return $this->render('common_view', [
            'model' => $article,
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
