<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\ArticleSearch;
use common\models\DailyCount;
use common\models\PsychotherapyItem;
use common\models\ReadWithIt;
use common\models\Tag;
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

        $articles = Article::find()
            ->where(['status'=>'publish'])
            ->andWhere('link2original != :value',['value'=>'masterpage'])
            ->with('psys','sites','tags')
            ->limit(100)
            ->all();
        $articleDataProvider = new ArrayDataProvider([
            'allModels'=>$articles,
            'pagination' => [
                'pageSize' => 10,
            ],
//            'sort' => [
//                'attributes' => ['id', 'username'],
//            ],
        ]);


//        popular
        $query = Article::find()
            ->select(['article.*', 'SUM(daily_count.count) AS countviews'])
            ->where(['status'=>'publish'])
            ->andWhere('link2original != :value',['value'=>'masterpage'])
            ->join('LEFT JOIN', DailyCount::tableName(), 'article.id=daily_count.article_id')
            ->groupBy('article.id')
            ->orderBy(['countviews' => SORT_DESC])
            ->limit(100);
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
        $article = Article::find()->where(['hrurl'=>$hrurl])->with('psys','sites','tags')->one();

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
//        $rows = ArticleSearch::find()->where(['match','text', $search])->all();
//        var_dump($search['search']); die;

//        $query = new \yii\elasticsearch\Query();
//        $query
////            ->query(['match'=>['text'=>$search]])
////            ->fields('id, text')
////            ->source($search['search'])
//            ->from('psihotera','article')
////            ->query(['match'=>['text'=>$search]])
////                ->search()
////            ->match(['text'=>$search])
//            ->limit(10);
//        $command = $query->createCommand();
//        $rows = $command->search();

//        var_dump($rows); die;

//        $dataProvider = new ActiveDataProvider([
//            'query' => Article::find(),
//            'pagination'=> [
//                'pageSize' => 100,
//            ],
//            'sort' =>[
//                'defaultOrder'=> [
//                    'id' => SORT_DESC
//                ]
//            ]
//        ]);
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
}
