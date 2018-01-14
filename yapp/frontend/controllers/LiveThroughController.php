<?php

namespace frontend\controllers;


use common\models\Feedback;

use common\models\TgBotUser;
use yii\filters\ContentNegotiator;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use Yii;
use yii\web\Response;


class LiveThroughController extends \yii\web\Controller
{

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

    public function beforeAction($action)
    {
        if (in_array($action->id, ['dialog'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }



    public function actionDialog()
    {

        $input = Yii::$app->request->getRawBody();
        $updateId = Yii::$app->request->post('update_id');
        $message = Yii::$app->request->post('message'); // array
        $callbackQuery = Yii::$app->request->post('callback_query'); // array
        $inlineQuery = Yii::$app->request->post('inline_query'); // array


        $messageId = $message['message_id'];
        $from = $message['from'];  // array
        $fromId = $message['from']['id'];
        $fromIsBot = $message['from']['is_bot'];
        $fromFirstName = $message['from']['first_name'];
        $fromLastName = $message['from']['last_name'];
        $fromUserName = $message['from']['username'];
        $fromLanguageCode = $message['from']['language_code'];
        $chat = $message['chat'];
        $chatId = $message['chat']['id'];
        $chatType = $message['chat']['type'];
        $date = $message['date'];
        $text = $message['text'];
        $query = $inlineQuery['query'];


        if ($message != null) {

//            /start
            if (trim(strtolower($message['text'])) == '/start') {
                $user = TgBotUser::find()->where(['tg_user_id'=>$message['from']['id']])->one();
                if ($user == null) {
                    $user = new TgBotUser();
                    $user['tg_user_id'] = $message['from']['id'];
                    $user['first_name'] = $message['from']['first_name'];
                    $user['last_name'] = $message['from']['last_name'];
                    $user['username'] = $message['from']['username'] ? $message['from']['username'] : 'noUsername';
                    $user['language_code'] = $message['from']['language_code'];
                    $user->save();
                }
                $this->sendMessage([
                    'chat_id' => $message['chat']['id'],  // $message['from']['id']
                    'parse_mode' => 'html',
                    'text' =>
                        'Я - <b>Переживание бот</b>. '.PHP_EOL.
                        'Приглашаю в путешествие по твоим эмоциям'.PHP_EOL.
                        'Прервать упражнение в любой точке можно командой /end '.PHP_EOL.
                        'Помощь - /help '.PHP_EOL.
                        'Наше путешествие имеет несколько дорог, выбирай:',
                    'reply_markup' => json_encode([
                        'inline_keyboard'=>[
                            [
                                ['text'=>"Выбор",'switch_inline_query_current_chat'=> 'play'],
                            ],
//                            [
//                                ['text'=>"настройки",'switch_inline_query_current_chat'=> 'phrase'],
//                            ],

                        ]
                    ]),
                ]);
                return [
                    'message' => 'ok',
                    'code' => 200,
                ];


            }
        }

        $this->sendMessage([
            'chat_id' => $message['from']['id'],
            'text' => 'end of script',
        ]);

        return ['message' => 'ok', 'code' => 200];


    }




    private function gameInit(array $message)
    {
        $commands = explode('/', $message['text']);
        $type = $commands[0];
        $hrurl = $commands[1];

        $goQuestion['question']='asdf';

        $this->sendMessage([
            'chat_id' => $message['from']['id'],
            'text' => $goQuestion['question'],
        ]);

        return ['message' => 'ok', 'code' => 200];
    }


    public function sendMessage(array $option)
    {
        $chat_id = $option['chat_id'];
        $text = urlencode($option['text']);
        unset($option['chat_id']);
        unset($option['text']);
        $jsonResponse = $this->curlCall("https://api.telegram.org/bot" .
            Yii::$app->params['lTTGBotToken'].
            "/sendMessage?chat_id=".$chat_id .
            '&text='.$text, $option);
        return json_decode($jsonResponse);
    }

    /**
     *   @var array
     *   $this->answerCallbackQuery([
     *       'callback_query_id' => '3343545121', //require
     *       'text' => 'text', //Optional
     *       'show_alert' => 'my alert',  //Optional
     *       'url' => 'http://sample.com', //Optional
     *       'cache_time' => 123231,  //Optional
     *   ]);
     *   The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     *  On success, True is returned.
     */
    public function answerCallbackQuery(array $option = [])
    {
        $jsonResponse = $this->curlCall("https://api.telegram.org/bot" .
            Yii::$app->params['lTTGBotToken'] .
            "/answerCallbackQuery", $option);
        return json_decode($jsonResponse);
    }

    /**
     *   @var array
     *   sample
     *   $this->answerInlineQuery([
     *       'inline_query_id' => Integer, //Required-Position in high score table for the game
     *       'user' => User, //Optional
     *       'score' => Integer,  //Optional
     *   ]);
     *
     */
    public function answerInlineQuery(array $option = [])
    {
//        $optionJs = json_encode($option);
        $jsonResponse = $this->curlCall("https://api.telegram.org/bot" .
            Yii::$app->params['lTTGBotToken'] .
            "/answerInlineQuery", $option);
        return json_decode($jsonResponse);
    }

    private function curlCall($url, $option=array(), $headers=array())
    {
        $attachments = ['photo', 'sticker', 'audio', 'document', 'video'];

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, "Telebot");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if (count($option)) {
            curl_setopt($ch, CURLOPT_POST, true);
            foreach($attachments as $attachment){
                if(isset($option[$attachment])){
                    $option[$attachment] = $this->curlFile($option[$attachment]);
                    break;
                }
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, $option);
        }
        $r = curl_exec($ch);
        if($r == false){
            $text = 'error '.curl_error($ch);
            Yii::info($text, 'chepuhoBot');
        } else {
            $info = curl_getinfo($ch);
            Yii::info($info, 'chepuhoBot');

        }
        curl_close($ch);
        return $r;
    }

    private function curlFile($path)
    {
        if (is_array($path))
            return $path['file_id'];
        $realPath = realpath($path);
        if (class_exists('CURLFile'))
            return new \CURLFile($realPath);
        return '@' . $realPath;
    }






    /**
     *   @var array
     *   sample
     *   $this->editMessageText([
     *       'chat_id' => '3343545121', //Optional
     *       'message_id' => 13123, //Optional
     *       'inline_message_id' => 'my alert',  //Optional
     *       'text' => 'my text', //require
     *       'parse_mode' => 123231,  //Optional
     *       'disable_web_page_preview' => false or true,  //Optional
     *       'reply_markup' => Type InlineKeyboardMarkup,  //Optional
     *   ]);
     *   Use this method to edit text and game messages sent by the bot or via the bot (for inline bots). On success,
     *  if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     */
    public function editMessageText(array $option = [])
    {
        $jsonResponse = $this->curlCall("https://api.telegram.org/bot" .
            Yii::$app->params['lTTGBotToken'] .
            "/editMessageText", $option);
        return json_decode($jsonResponse);
    }
    /**
     *   @var array
     *   sample
     *   $this->editMessageText([
     *       'chat_id' => '3343545121', //Required
     *       'message_id' => 13123, //Optional
     *       'inline_message_id' => 'my alert',  //Optional
     *       'caption' => 'my text', //require
     *       'reply_markup' => Type InlineKeyboardMarkup,  //Optional
     *   ]);
     *
     *   Use this method to edit captions of messages sent by the bot or via the bot (for inline bots). On success,
     *    if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
     */
    public function editMessageCaption(array $option = [])
    {
        $jsonResponse = $this->curlCall("https://api.telegram.org/bot" .
            Yii::$app->params['lTTGBotToken'] .
            "/editMessageCaption", $option);
        return json_decode($jsonResponse);
    }

    /**
     *   @var array
     *   $this->deleteMessage([
     *       'chat_id' => '3343545121', //Required
     *       'message_id' => 13123, //Required
     *   ]);
     *   Use this method to delete a message, including service messages, with the following limitations:
     *   - A message can only be deleted if it was sent less than 48 hours ago.
     *   - Bots can delete outgoing messages in groups and supergroups.
     *   - Bots granted can_post_messages permissions can delete outgoing messages in channels.
     *   - If the bot is an administrator of a group, it can delete any message there.
     *   - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
     *   Returns True on success.
     */
    public function deleteMessage(array $option = [])
    {
        $jsonResponse = $this->curlCall("https://api.telegram.org/bot" .
            Yii::$app->params['lTTGBotToken'] .
            "/deleteMessage", $option);
        return json_decode($jsonResponse);
    }




}
//
