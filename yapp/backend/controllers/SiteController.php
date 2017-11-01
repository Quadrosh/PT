<?php
namespace backend\controllers;

use common\models\AdminLoginForm;
use common\models\Article;
use common\models\ArticleSearch;
use common\models\Master;
use common\models\MasterSearch;
use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $layout = 'site';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'logout'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'index',
                            'search-index',
                            'search-index-delete',
                        ],
                        'allow' => true,
//                        'roles' => ['@'],
                        'roles' => ['viewAdminPage']
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Url::remember();
        $this->layout = 'main';
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionSearchIndex()
    {

        $ArtIter =0;
        $MasIter =0;
        $sources = Master::find()->all();
        foreach ($sources as $source) {
            $searchItem = MasterSearch::find()->where(['id'=>$source['id']])->one();
            if (!$searchItem) {
                $searchItem = new MasterSearch();
                $searchItem->setPrimaryKey($source['id']);
            }
            $searchItem['id'] = $source['id'];
            $searchItem['username'] = $source['username'];
            $searchItem['hrurl'] = $source['hrurl'];
            $searchItem['other_contacts'] = $source['other_contacts'];
            $searchItem['hello'] = $source['hello'];
            $searchItem['name'] = $source['name'];
            $searchItem['middlename'] = $source['middlename'];
            $searchItem['surname'] = $source['surname'];
            $searchItem['phone'] = $source['phone'];
            $searchItem['address'] = $source['address'];
            $searchItem['list_add'] = $source['list_add'];
            if(isset($source->cities)){
                    $cities='';
                    $i = 0;
                    foreach ($source->cities as $city) {
                        if ($i == 0) {
                            $cities.=$city['name'];
                        } else {
                            $cities.=', '.$city['name'];
                        }
                        $i++;
                    }
                $searchItem['city'] = $cities;
            }
            if(isset($source->sites)){
                $sites='';
                $i = 0;
                foreach ($source->sites as $site) {
                    if ($i == 0) {
                        $sites.=$site['name'];
                    } else {
                        $sites.=', '.$site['name'];
                    }
                    $i++;
                }
                $searchItem['site_id'] = $sites;
            }
            if(isset($source->psys)){
                $psys='';
                $i = 0;
                foreach ($source->psys as $psy) {
                    if ($i == 0) {
                        $psys.=$psy['name'];
                    } else {
                        $psys.=', '.$psy['name'];
                    }
                    $i++;
                }
                $searchItem['psys'] = $psys;
            }
            if(isset($source->tags)){
                $tags='';
                $i = 0;
                foreach ($source->tags as $tag) {
                    if ($i == 0) {
                        $tags.=$tag['name'];
                    } else {
                        $tags.=', '.$tag['name'];
                    }
                    $i++;
                }
                $searchItem['tags'] = $tags;
            }
            if(isset($source->mtexts)){
                $mtexts='';
                $i = 0;
                foreach ($source->mtexts as $mtext) {
                    if ($i == 0) {
                        $mtexts.=$mtext['list_name'];
                    } else {
                        $mtexts.=', '.$mtext['list_name'];
                    }
                    $i++;
                }
                $searchItem['mtexts'] = $mtexts;
            }
            if(isset($source->sessionAssighs)){
                $sessions='';
                $i = 0;
                foreach ($source->sessionAssighs as $session) {
                    if ($i == 0) {
                        $sessions.= $session->sessionType['name'].' - '.$session['value'].$session['comment'];
                    } else {
                        $sessions.=', '. $session->sessionType['name'].' - '.$session['value'].$session['comment'];
                    }
                    $i++;
                }
                $searchItem['sessions'] = $sessions;
            }

            if ($searchItem->save()) {
                $MasIter++;
            }
        }


        $sources = Article::find()->all();
        foreach ($sources as $source) {
            $searchItem = ArticleSearch::find()->where(['id'=>$source['id']])->one();
            if (!$searchItem) {
                $searchItem = new ArticleSearch();
                $searchItem->setPrimaryKey($source['id']);
            }
            if ($source['status'] == 'publish' AND $source['link2original'] != 'masterpage') {
                $searchItem['id'] = $source['id'];
                $searchItem['list_name'] = $source['list_name'];
                $searchItem['hrurl'] = $source['hrurl'];
                $searchItem['pagehead'] = $source['pagehead'];
                $searchItem['text'] = $source['text'];
                $searchItem['excerpt'] = $source['excerpt'];
                $searchItem['excerpt_big'] = $source['excerpt_big'];
                $searchItem['author'] = $source['author'];
                if(isset($source->sites)){
                    $sites='';
                    $i = 0;
                    foreach ($source->sites as $site) {
                        if ($i == 0) {
                            $sites.=$site['name'];
                        } else {
                            $sites.=', '.$site['name'];
                        }
                        $i++;
                    }
                    $searchItem['sites'] = $sites;
                }
                if(isset($source->psys)){
                    $psys='';
                    $i = 0;
                    foreach ($source->psys as $psy) {
                        if ($i == 0) {
                            $psys.=$psy['name'];
                        } else {
                            $psys.=', '.$psy['name'];
                        }
                        $i++;
                    }
                    $searchItem['psys'] = $psys;
                }
                if(isset($source->tags)){
                    $tags='';
                    $i = 0;
                    foreach ($source->tags as $tag) {
                        if ($i == 0) {
                            $tags.=$tag['name'];
                        } else {
                            $tags.=', '.$tag['name'];
                        }
                        $i++;
                    }
                    $searchItem['tags'] = $tags;
                }
                if(isset($source->master)){

                    $searchItem['master_id'] = $source->master['username']
                        .' '.$source->master['name']
                        .' '.$source->master['middlename']
                        .' '.$source->master['surname'];
                }

                if ($searchItem->save()) {
                    $ArtIter++;
                }
            }
        }

        Yii::$app->session->setFlash('success','Проиндексировано ' . $MasIter . ' мастеров и ' . $ArtIter . ' статей.');

          return $this->redirect(Url::previous());

    }
    public function actionSearchIndexDelete()
    {

        $ArtIter =0;
        $MasIter =0;
        $masterSearches = MasterSearch::find()->all();
        foreach ($masterSearches as $masterSearch) {
            $masterSearch->delete();
            $MasIter++;
        }
        $articleSearches = ArticleSearch::find()->all();
        foreach ($articleSearches as $articleSearch) {
            $articleSearch->delete();
            $ArtIter++;
        }





        Yii::$app->session->setFlash('success','Удалено из поискового индекса ' . $MasIter . ' мастеров и ' . $ArtIter . ' статей.');

        return $this->redirect(Url::previous());

    }
}
