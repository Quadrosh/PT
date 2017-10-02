<?php

namespace frontend\controllers;


use common\models\Master;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\filters\VerbFilter;

use common\models\Feedback;
use yii\web\HttpException;
use yii\base\ErrorException;

class SendController extends Controller
{
    public $layout = 'main';
//    public $defaultAction = 'index';
    /**
     * @inheritdoc
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'only' => ['logout'],
//                'rules' => [
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return
            [
                'error' => [
                    'class' => 'yii\web\ErrorAction',
                    'view' => '@app/views/site/custom_error.php',
                ],
                'captcha' => [
                    'class' => 'yii\captcha\CaptchaAction',
                    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                ],
            ];
    }
//    public function actionError()
//    {
//
//    }



    public function actionFeedback()
    {
        $feedback = new Feedback();
        $feedback->load(Yii::$app->request->post());
        $master = Master::find()->where(['id'=>$feedback['master_id']])->one();

        if ($feedback->save()) {
            if ($feedback->sendEmail( 'PSIHOTERA.RU: Заявка',$master['email'])) {
                Yii::$app->session->setFlash('success', 'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');
                return $this->redirect(Url::previous());
            } else {
                Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз.');
                return $this->redirect(Url::previous());
            }
        } else {
            Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на webmaster@psihotera.ru');
            return $this->redirect(Url::previous());
        }

    }






}
