<?php

namespace frontend\controllers;


use common\models\Master;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\httpclient\Client;
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
            if ($master['order_messenger'] == 'email') {
                if ($this->sendEmail($master,$feedback)) {
                    Yii::$app->session->setFlash('success', 'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');
                } else {
                    Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на webmaster@psihotera.ru');
                }
            }

            if ($master['order_sms_enable'] == true) {
                $this->sendSms($master,$feedback);
            }
        } else {
            Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на webmaster@psihotera.ru');
        }
        return $this->redirect(Url::previous());
    }

    /*
     * @var $master common\models\Master
     * @var $feedback common\models\Feedback
     * */
    private function sendEmail($master, $feedback){
        if ($feedback->sendEmail( 'PSIHOTERA.RU: Заявка',$master['order_messenger_id'])) {
            return $this->redirect(Url::previous());
        } else {
            Yii::$app->session->setFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз.');
            return $this->redirect(Url::previous());
        }
    }




    private function sendSms($master, $feedback)
    {
        if ($master['order_phone']!=null) {
            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('post')
                ->setUrl('https://sms.ru/sms/send')
                ->setData([
                    'api_id' => Yii::$app->params['sms_api_id'],
                    'to' => '79853461615, '.$master['order_phone'],
                    'text'=> 'Psihotera'.$master['id'].' - заявка с сайта, имя - '.$feedback['name'].', телефон - '.$feedback['phone'],
                ])
                ->send();
            if ($response->isOk) {
                Yii::$app->session->setFlash('success','сообщение отправлено');
            } else {
                Yii::$app->session->setFlash('error','что-то пошло не так');
            }
        }

    }





}
