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
        $master = Master::findOne($feedback['master_id']);

        if ($feedback->save()) {
            if ($feedback->notifyAboutOrder()) {
                Yii::$app->session->addFlash('success', 'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');
            } else {
                Yii::$app->session->addFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз.');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Во время сохранения заявки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на webmaster@psihotera.ru');
        }
        return $this->redirect(Url::previous());
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
                Yii::$app->session->addFlash('success','сообщение отправлено');
            } else {
                Yii::$app->session->addFlash('error','что-то пошло не так');
            }
        }

    }



    public function actionRequestAppointment()
    {


        $feedback = new Feedback();
        $feedback->load(Yii::$app->request->post());
        $feedback->type = Feedback::TYPE_TO_MASTER;

        if ($feedback->save()) {
            if ($feedback->notifyAboutOrder()) {
                Yii::$app->session->addFlash('success', 'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');
            } else {
                Yii::$app->session->addFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз.');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на webmaster@psihotera.ru');
        }
        return $this->redirect(Url::previous());
    }





    public function actionOrderToPsihotera()
    {


        $feedback = new Feedback();
        $feedback->load(Yii::$app->request->post());
        $feedback->type = Feedback::TYPE_TO_PSIHOTERA;

        if ($feedback->save()) {
            if ($feedback->notifyAboutOrder()) {
                Yii::$app->session->addFlash('success', 'Ваша заявка отправлена. <br> Мы свяжемся с Вами в ближайшее время.');
            } else {
                Yii::$app->session->addFlash('error', 'Во время отправки произошла ошибка.');
            }
        } else {
            Yii::$app->session->addFlash('error', 'Во время отправки произошла ошибка, попробуйте еще раз. Или отправьте заявку в свободной форме на webmaster@psihotera.ru');
        }
        return $this->redirect(Url::previous());
    }



}
