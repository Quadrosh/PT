<?php

namespace common\models;


use yii\base\Model;
use yii\filters\ContentNegotiator;
use yii\helpers\Json;
use yii\web\UploadedFile;
use Yii;
use yii\web\Response;


class BotTelega extends Model
{

    public $name;

    public function behaviors() {
        return [
            'contentNegotiator' => [
                'class'   => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                ],
            ],
//            'rateLimiter'       => [
//                'class' => RateLimiter::className(),
//            ],
//            'authenticator' => [
//                'class' => \app\components\auth\QueryParamAuth::className(),
////                'except' => [ 'create' ],
//            ],
        ];
    }

//    public function rules()
//    {
//        return [
//            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, svg'],
//        ];
//    }

    public function sendPTOrderNotification(array $options, $dataInBody = false)
    {
//        $this->request['answer'] = $options['text'];
//        $this->request['answer_time'] = time();
//        $this->request->save();
        $chat_id = $options['chat_id'];
        $urlEncodedText = urlencode($options['text']);
        $jsonResponse = $this->sendToUser('https://api.telegram.org/bot' .
            Yii::$app->params['ptTGBotToken'].
            '/sendMessage?chat_id='.$chat_id .
            '&text='.$urlEncodedText, $options, $dataInBody);
        return Json::decode($jsonResponse);
    }


    private function sendToUser($url, $options = [], $dataInBody = false)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Telebot');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (count($options)) {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($dataInBody) {
                $bodyOptions = $options;
                unset($bodyOptions['chat_id']);
                unset($bodyOptions['text']);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyOptions);
            }
        }
        $r = curl_exec($ch);
        if($r == false){
            $text = 'curl error '.curl_error($ch);
            Yii::info($text, 'b2bBot');
        } else {
            $info = curl_getinfo($ch);
            $info['url'] = str_replace(Yii::$app->params['ptTGBotToken'],'_ptTGBotToken_',  $info['url']);
            $info['url'] = str_replace(Yii::$app->params['lTTGBotToken'],'_lTTGBotToken_',  $info['url']);
            $info = [
                    'action'=>'curl to User',
                    'options'=>$options,
                    'dataInBody'=>$dataInBody,
                ] + $info;
            Yii::info($info, 'b2bBot');
        }
        curl_close($ch);
        return $r;
    }







}