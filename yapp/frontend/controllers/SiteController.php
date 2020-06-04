<?php
namespace frontend\controllers;

use common\models\Article;
use common\models\DailyCount;
use common\models\Imagefiles;
use common\models\Master;
use common\models\Quote;
use Yii;
use yii\base\InvalidParamException;
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
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'site_index';
        $this->view->params['title'] = 'Психотера - все о психотерапии';
        $this->view->params['description'] = 'описание';
        $this->view->params['keywords'] = 'психотерапия, психотерапевт';

        //Quote counter
        $session = Yii::$app->session;
        if ($session['quote']!=null) {
            $session['quote']+=1;
        } else {
            $session['quote']=1;
        }
        $quote = Quote::find()->where(['id'=>$session['quote']])->one();
        if ($quote == null) {
            $session['quote']+=1;
            $quote = Quote::find()->where(['id'=>$session['quote']])->one();
            if ($quote == null) {
                $session['quote']=1;
                $quote = Quote::find()->where(['id'=>$session['quote']])->one();
            }
        }

//        popular
        $popArtQuery = Article::find()
            ->select(['article.*', 'SUM(daily_count.count) AS countviews'])
            ->where(['type'=>Article::TYPE_ARTICLE,'status'=>'publish'])
            ->andWhere('link2original != :value',['value'=>'masterpage'])
            ->join('LEFT JOIN', DailyCount::tableName(), 'article.id=daily_count.article_id')
            ->groupBy('article.id')
            ->orderBy(['countviews' => SORT_DESC])
            ->limit(10);
        $popularArticles = $popArtQuery->all();

        $popMasterQuery = Master::find()
            ->select(['master.*', 'SUM(daily_count.count) AS countviews'])
//            ->where(['status'=>'premium'])
            ->join('LEFT JOIN', DailyCount::tableName(), 'master.id=daily_count.master_id')
            ->groupBy('master.id')
            ->orderBy(['countviews' => SORT_DESC])
            ->limit(10);
        $popularMasters = $popMasterQuery->all();

        $masterDataProvider = new ArrayDataProvider([
            'allModels'=>$popularMasters,
            'pagination' => [
                'pageSize' => 20,
            ],
//            'sort' => [
//                'attributes' => ['id', 'username'],
//            ],
        ]);



        return $this->render('homepage', [
            'quote' => $quote,
            'popularArticles' => $popularArticles,
            'popMasterDataProvider' => $masterDataProvider,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


    /**
     * Создание изображения для просмотра
     * @throws BadRequestHttpException
     * @throws  NotFoundHttpException
     */
    public function actionGetImage($name){

        if (Imagefiles::constructImage($name)) {
            $this->refresh();
        }

    }


    public function actionReset()
    {
        $session = Yii::$app->session;
        unset($session['utm_source']);
        unset($session['utm_medium']);
        unset($session['utm_campaign']);
        unset($session['utm_term']);
        unset($session['utm_content']);
//        echo '<pre>'.print_r($session,true).'</pre>';die;

        Yii::$app->session->addFlash('success','Данные UTM в сессии обнулены');
        return $this->redirect(Url::previous());
    }
}
