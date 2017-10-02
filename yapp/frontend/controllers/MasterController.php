<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\BtnItem;
use common\models\ItemAssign;
use common\models\Master;
use common\models\MasterpageItem;
use common\models\ProfessionItem;
use common\models\PsychotherapyItem;
use common\models\SiteItem;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
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
        $this->view->params['title'] = 'Психотера - все о психотерапии - Статьи';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';

        $mastersQ = Master::find()->with('pros', 'psys', 'sites', 'btns')->limit(100)->all();


        $masterDataProvider = new ArrayDataProvider([
//            'allModels'=>$mastersData,
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
        ]);
    }

    public function actionView($hrurl)
    {
        $this->layout = 'master';
        Url::remember();
        $master = Master::find()->where(['hrurl'=>$hrurl])->one();

        $session = Yii::$app->session;
        if (Yii::$app->request->get('utm_source')!= null) {
            $session['utmSource'] = Yii::$app->request->get('utm_source');
            $session['utmMedium'] = Yii::$app->request->get('utm_medium');
            $session['utmCampaign'] = Yii::$app->request->get('utm_campaign');
            $session['utmTerm'] = Yii::$app->request->get('utm_term');
            $session['utmContent'] = Yii::$app->request->get('utm_content');
        }

        $masterData=[];
        $masterData['professions'] = $master->pros;
        $masterData['psys'] = $master->psys;
        $masterData['sites'] = $master->sites;

        $masterPages = Article::find()->where(['master_id'=>$master['id'],'link2original'=>'masterpage','status'=>'publish'])->all();
        $this->view->params['background_image'] = $master['background_image'];

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




}
