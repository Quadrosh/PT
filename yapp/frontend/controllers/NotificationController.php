<?php

namespace frontend\controllers;



use common\models\BotTelega;
use common\models\Master;
use common\models\NotificationRequest;
use yii\filters\ContentNegotiator;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use Yii;
use yii\web\Response;


class NotificationController extends \yii\web\Controller
{
    /**
     * @var Master
     */
    private $user;


    /**
     * @var B2bBotRequest
     */
    private $request;

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
        if (in_array($action->id, ['telegin'])) {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }


    /*
     * Основной метод, принимает запросы от пользователя.
     *
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     *    ['message' => 'ok', 'code' => 200]
     * */
    public function actionTelegin()
    {
        $input = Yii::$app->request->getRawBody();
        $updateId = Yii::$app->request->post('update_id');
        $message = Yii::$app->request->post('message'); // array
        $callbackQuery = Yii::$app->request->post('callback_query'); // array
        $inlineQuery = Yii::$app->request->post('inline_query'); // array

        Yii::info([
            'action'=>'request from Master Telega',
            'input'=>Json::decode($input),
        ], 'psihoteraBot');

        $userTgId = null;
        if ($message) {
            $userTgId = $message['from']['id'];
        } elseif ($inlineQuery){
            $userTgId = $inlineQuery['from']['id'];
        } elseif ($callbackQuery){
            $userTgId = $callbackQuery['from']['id'];
        } else {
            $userTgId = null;
        }

        $user = Master::find()->where([
            'order_messenger'=>'telegram',
            'order_messenger_id'=>$userTgId
        ])->one();


        $this->user = $user;


        // request save
        $this->request = new NotificationRequest;
        $this->request['messenger'] = 'telegram';
        $this->request['user_id'] = $userTgId;
        $this->request['update_id'] = strval($updateId);
        $this->request['user_time'] = intval($message['date']);
        if ($message) {
            if ($message['text']) {
                $this->request['request'] = $message['text'];
            } elseif ($message['contact']){
                $this->request['request'] = 'phone/'.$message['contact']['phone_number'];
            } else {
                $this->request['request'] = 'no text';
            }

        } elseif ($inlineQuery){
            $this->request['request'] = 'inlineQuery '.$inlineQuery['query'];
        } elseif ($callbackQuery){
            $this->request['request'] = 'callbackQuery '.$callbackQuery['data'];
        }
        $this->request->save();




        if ($inlineQuery) {
          return $this->inlineQueryAction($inlineQuery);
        }

        if ($message) {
            return $this->textMessageAction($message);
        }

        if ($callbackQuery) {
            return $this->callBackQueryAction($callbackQuery);
        }

    }





    /*
     * Обработка входящего текстового сообщения
     *
     * @var array $message
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function textMessageAction($message){
        $bot = new BotTelega;
        $bot->request = $this->request;
        return $bot->sendPTOrderNotification([
            'chat_id' => $this->request['user_id'],
//            'chat_id' => $this->user['telegram_user_id'],
            'text' => 'чек чек',
        ]);

//        if (trim(strtolower($message['text'])) == '/start') {
//            return $this->helloMessage();
//        }
//
//
//        elseif (substr($message['text'],0,6) == 'order/' ){
//
//            $commandArr = explode('/', $message['text']);
//            $orderId = $commandArr[1];
//            return $this->order($orderId);
//        }
//
//
//        elseif (strtolower($message['text']) == '/options' ||
//            $message['text'] == 'Опции'){
//            return $this->options();
//        }
//
//
//
//
//        elseif (trim(strtolower($message['text'])) == '/help' ||
//            $message['text'] == 'Помощь') {
//            return $this->help();
//        }
//
//
//
//
//
//
//
//
//        $this->sendMessage([
//            'chat_id' => $message['from']['id'],
//            'text' => 'нет такой команды',
//        ]);
//        return $this->options();

    }


    /*
     * Обработка входящего сообщения типа Callback Query
     * при старте обработки отправляет сообщение типа answerCallbackQuery
     * (индикация что запрос принят и обрабатывается)
     * обрабатывает поле 'data'
     *
     * @var array $callbackQuery
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function callbackQueryAction($callbackQuery)
    {
        $this->answerCallbackQuery([
            'callback_query_id' => $callbackQuery['id'],
            'text' => 'В процессе...',
        ]);
        Yii::info([
            'action'=>'request Callback Query',
            'updateId'=>$this->request['update_id'],
            'callbackQuery'=>$callbackQuery,
        ], 'b2bBot');

        if ($callbackQuery['data'] == '/orders') {
            return $this->orders();
        }
        elseif ($callbackQuery['data'] == '/options') {
            return $this->options();
        }

        return ['message' => 'ok', 'code' => 200];
    }


    /*
     * Обработка входящего сообщения типа Inline Query
     *
     * Отправляет пользователю массив результатов
     * пользователь получает результаты в виде всплывающего списка и выбирает один из них.
     * Боту отправляется текстовое сообщение поля input_message_content -> message_text
     *
     * @var array $inlineQuery
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function inlineQueryAction($inlineQuery)
    {
        Yii::info([
            'action'=>'request Inline Query',
            'updateId'=>$this->request['update_id'],
            'inlineQuery'=>$inlineQuery,
        ], 'b2bBot');

//           список заказов
        if ($inlineQuery['query'] == '/order_details') {
            $serverResponse = $this->getOrdersFromServer([
                'phone' => $this->dealer['phone'],
            ]);

            Yii::info([
                'action'=>'response from Server for Inline Query',
                'updateId'=>$this->request['update_id'],
                '$inlineQueryId'=>$inlineQuery['id'],
                'serverResponse'=>$serverResponse,
            ], 'b2bBot');

            if (isset($serverResponse['error'])) {
                return $this->sendErrorInline($serverResponse['message'],$inlineQuery['id']);
            }

            $results = [];
            foreach ($serverResponse as $order) {
                $results[] = [
                    'type' => 'article',
                    'id' => $order['orderId'],
                    'title' =>
                        $order['orderId'].', '.$order['totalItems'].'поз., '.$order['totalCost'].'р.',
                    'description' =>
                        'Доставка - '.$order['deliveryType']
                        .' / '.$order['status']['status']
                        .' / '.$order['status']['payment']
                        .' / '.$order['status']['delivey'],
                    'input_message_content'=>[
                        'message_text'=> 'order/' . $order['orderId'],
                        'parse_mode'=> 'html',
                        'disable_web_page_preview'=> true,
                    ],
                ];
            };
            $this->answerInlineQuery([
                'inline_query_id' => $inlineQuery['id'],
                'is_personal' => true,
                'results'=> Json::encode($results)
            ]);
        }

        return ['message' => 'ok', 'code' => 200];
    }


    /*
     * Отправка пользователю опций
     *
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function options()
    {
        $this->sendMessageWithBody([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => 'Список доступных опций показан ниже на клавиатуре:',
            'reply_markup' => Json::encode([
                'one_time_keyboard'=> true,
                'keyboard'=>[
                    [
                        ['text'=>'Инфо по артикулу'],
                        ['text'=>'Поиск товара']
                    ],
                    [
                        ['text'=>'Сообщение менеджеру'],
                        ['text'=>'Помощь'],
                    ],
                    [
                        ['text'=>'Мои заказы'],
                    ],
                ]
            ]),

        ]);
        return ['message' => 'ok', 'code' => 200];
    }


    /*
     * Отправка пользователю памятки помощи
     *
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function help(){
        $text =
            'Доступные команды:'.PHP_EOL.
            '/orders - оформленные накладные'.PHP_EOL.
            'order/МУЗ0000001 - информация по заказу'.PHP_EOL.
            '/search - поиск товара в базе, ответ ограничен 10-ю результатами'.PHP_EOL.
            '/search_20 - поиск товара в базе, ответ ограничен 20-ю результатами'.PHP_EOL.
            '/search_30 - поиск товара в базе, ответ ограничен 30-ю результатами'.PHP_EOL.
            '/product - информация по артикулу'.PHP_EOL.
            'product/a000001 - информация по артикулу в один клик'.PHP_EOL.
            '/email - отправить сообщение менеджеру'.PHP_EOL.
            '/unauthorize - отменить авторизацию и удалить привязку к дилеру'.PHP_EOL.
            '/help - памятка помощи'.PHP_EOL.
            PHP_EOL
        ;
        $this->sendMessageWithBody([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => $text,
            'reply_markup' => Json::encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>'Опции', 'callback_data'=> '/options'],
                    ],

                ]
            ]),

        ]);
        return ['message' => 'ok', 'code' => 200];
    }


    /*
     * Отправка пользователю приветственного сообщения
     *
     * @return boolean $this->checkAuth()
     * */
    private function helloMessage(){

        $this->sendMessage([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => 'Привет, я ATtrade_bot. Сначала Вам необходимо пройти авторизацию.',
        ]);
        return $this->checkAuth();
    }


    /*
     * Инициализация отправки сообщения менеджеру
     * изменяет поле 'bot_command' пользователя
     * при незаполненнх полях 'real_first_name' и 'real_last_name' запрашивает у пользователя имя/фамилию и сохраняет
     *
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function emailInit(){

        // если пустые поля Имя Фамилия (real_first_name / last_name_request)
        if (!$this->user['real_first_name']) {
            if ($this->user['bot_command'] == 'first_name_request') {
                $this->user['real_first_name'] = $this->request['request'];
                $this->user['bot_command'] = 'last_name_request';
                $this->user->save();
                $this->sendMessage([
                    'chat_id' => $this->user['telegram_user_id'],
                    'text' => 'Пожалуйста, уточните Вашу Фамилию.'.PHP_EOL.'Отправьте ответным сообщением',
                ]);
                return ['message' => 'ok', 'code' => 200];
            } else {
                $this->user['bot_command'] = 'first_name_request';
                $this->user->save();
                $this->sendMessage([
                    'chat_id' => $this->user['telegram_user_id'],
                    'text' => 'Пожалуйста, уточните Ваше Имя.'.PHP_EOL.'Отправьте его ответным сообщением',
                ]);
                return ['message' => 'ok', 'code' => 200];
            }
        }

        if ($this->user['bot_command'] == 'last_name_request') {
            $this->user['real_last_name'] = $this->request['request'];
            $this->user->save();
        }

        $this->user['bot_command'] = 'sendEmail';
        $this->user->save();

        $this->sendMessage([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => 'Отправка сообщения менеджеру.'.PHP_EOL.'Введите текст',
        ]);
        return ['message' => 'ok', 'code' => 200];
    }


    /*
     * отправка сообщения в b2b отдел
     *
     * @var string $text
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function emailProcess($text){
        $this->user['bot_command'] = null;
        $this->user->save();

        if ($this->dealer->sendEmail($text, $this->user['real_first_name'].' '.$this->user['real_last_name'])) {
            $this->sendMessage([
                'chat_id' => $this->user['telegram_user_id'],
                'text' => 'Сообщение отправлено.',
            ]);
            return ['message' => 'ok', 'code' => 200];
        } else {
            $this->sendMessage([
                'chat_id' => $this->user['telegram_user_id'],
                'text' => 'Не удалось отправить сообщение. Повторите попытку позже.',
            ]);
            return ['message' => 'ok', 'code' => 200];
        }
    }

    /*
     * Инициализация запроса в базе по одному артикулу
     * изменяет поле 'bot_command' пользователя
     * отправляет пользователю запрос на ввод артикула
     *
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function oneProductInit(){

        $this->user['bot_command'] = 'oneProductInfo';
        $this->user->save();

        $this->sendMessage([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => 'Информация по товару.'.PHP_EOL.'Отправьте контрольный номер',
        ]);
        return ['message' => 'ok', 'code' => 200];
    }

    /*
     * Обработка запроса по одному артикулу
     * запрашивает у сервера информацию
     * отправляет результат пользователю
     *
     * @var string $query  Артикул
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function oneProductProcess($query)
    {
        $this->user['bot_command'] = null;
        $this->user->save();
        $serverResponse = $this->getOneProductFromServer([
            'phone' => $this->dealer['phone'],
            'productCode' => $query
        ]);
        Yii::info([
            'action'=>'response from Server - one product info',
            'updateId'=>$this->request['update_id'],
            'serverResponse'=>$serverResponse,
        ], 'b2bBot');

        if (isset($serverResponse['error'])) {
            return $this->sendErrorMessage('Ошибка - '.$serverResponse['message']);
        }

        $responseToUser = '';
        mb_internal_encoding('utf-8');
        if (mb_strlen($serverResponse['description']) >3000) {
            $serverResponse['description'] = mb_substr($serverResponse['description'], 0, 3000).'...';
        }
        $responseToUser .= $serverResponse['productCode']
            .' '.$serverResponse['model']
            .PHP_EOL .' '.$serverResponse['description']
            .PHP_EOL
            .'Цена '.$serverResponse['retailPrice']
            .' / '.$serverResponse['personalPrice'].', '
            .'наличие ' .$serverResponse['quantity']['stock'].', '
            .'в пути ' .$serverResponse['quantity']['inroute']
            .PHP_EOL .'-------------------------'.PHP_EOL;


        $this->sendMessage([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => $responseToUser,
        ]);

        return ['message' => 'ok', 'code' => 200];
    }


    /*
     * Инициализация поиска в базе по ключевой фразе
     * изменяет поле 'bot_command' пользователя на search или search_[количество результатов]
     * отправляет пользователю запрос на ввод ключевой фразы для поиска
     *
     * @var integer $limit  ограничение количества запросов
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function searchInit($limit = 10){
        $text = 'Поисковый запрос по умолчанию ограничен 10-ю результатами. Изменение настроек - команды /search_20 и /search_30 соответственно';
        if ($limit != 10) {
            $text = 'Поиск '.$limit.' результатов';
            $this->user['bot_command'] = 'search_'.$limit;
        } else {
            $this->user['bot_command'] = 'search';
        }
        $this->user->save();


        $this->sendMessage([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => $text.PHP_EOL.PHP_EOL.'Отправьте поисковый запрос',
        ]);
        return ['message' => 'ok', 'code' => 200];
    }

    /*
     * Обработка поиска в базе по ключевой фразе
     * запрашивает у сервера информацию
     * отправляет результат пользователю
     *
     * @var string $query  поисковая фраза
     * @var integer $limit  количество результатов, до которого ограничен ответ поиска
     * @return array Массив с кодом 200 (индикация успешной обработки запроса)
     * */
    private function searchProcess($query, $limit = 10)
    {
        $this->user['bot_command'] = null;
        $this->user->save();
        $serverResponseArr = $this->getSearchResultsFromServer([
            'phone' => $this->dealer['phone'],
            'query' => $query,
            'limit' => $limit,
        ]);
        Yii::info([
            'action'=>'response from Server - search',
            'updateId'=>$this->request['update_id'],
            'serverResponse'=>$serverResponseArr,
        ], 'b2bBot');
        if (isset($serverResponseArr['error'])) {
            return $this->sendErrorMessage('Ошибка - '.$serverResponseArr['message']);
        }
        if ($serverResponseArr == []) {
            return $this->sendErrorMessage('Поиск не дал результов');
        }

        $responseToUser = '';
        mb_internal_encoding('utf-8');
        $iter = 0;
        foreach ($serverResponseArr as $item) {
            if (mb_strlen($item['description']) > 200) {
                $item['description'] = mb_substr($item['description'], 0, 200).'...';
            }
            $responseToUser .= $item['productCode']
                .' '.$item['model']
                .PHP_EOL .' '.$item['description']
                .PHP_EOL
                .'Цена '.$item['retailPrice']
                .' / '.$item['personalPrice'].', '
                .'наличие ' .$item['quantity']['stock'].', '
                .'в пути ' .$item['quantity']['inroute']
                .PHP_EOL .'-------------------------'.PHP_EOL;
            $iter++;
            if (count($serverResponseArr)>10 && $iter == 10) {
                $this->sendMessage([
                    'chat_id' => $this->user['telegram_user_id'],
                    'text' => $responseToUser,
                ]);
                $responseToUser='';
                $iter = 0;
            }

        }


        $this->sendMessage([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => $responseToUser,
        ]);

        return ['message' => 'ok', 'code' => 200];
    }


    private function order($orderId)
    {
        $serverResponse = $this->getOrderFromServer([
            'phone' => $this->dealer['phone'],
            'orderId' => $orderId,
        ]);
        Yii::info([
            'action'=>'response from Server - order',
            'updateId'=>$this->request['update_id'],
            'serverResponse'=>$serverResponse,
        ], 'b2bBot');

        if (isset($serverResponse['error'])) {
            return $this->sendErrorMessage('Ошибка - '.$serverResponse['message']);
        }
        if ($serverResponse == []) {
            return $this->sendErrorMessage('Поиск не увенчался успехом');
        }

        $responseToUser = $orderId.' - '
            .$serverResponse['totalCost'].'р.'
            .PHP_EOL
            .$serverResponse['status']['status'].' | '
            .$serverResponse['status']['payment'].' | '
            .$serverResponse['status']['delivey'].'  '
            .PHP_EOL
//            .'-------------------------'
            .PHP_EOL;
        foreach ($serverResponse['items'] as $item) {
            $responseToUser .= $item['productCode']
                .' '.$item['productName']
                .PHP_EOL
                .'заказ: '.$item['quantity'].', '
                .'резерв: '.$item['availability'].', '
                .'цена: ' .$item['price'].'р.'
                .PHP_EOL .'-------------------------'.PHP_EOL;
        }

        $this->sendMessageWithBody([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => $responseToUser,
            'reply_markup' => Json::encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>'Мои заказы', 'callback_data'=> '/orders'],
                        ['text'=>'Опции', 'callback_data'=> '/options'],
                    ],
                ]
            ]),
        ]);

        return ['message' => 'ok', 'code' => 200];
    }


    private function orders()
    {
        $orders = $this->getOrdersFromServer([
            'phone' => $this->dealer['phone'],
        ]);

        Yii::info([
            'action'=>'response from Server - orders',
            'updateId'=>$this->request['update_id'],
            'serverResponse'=>$orders,
        ], 'b2bBot');

        if (isset($orders['error'])) {
            return $this->sendErrorMessage('Ошибка - '.$orders['message']);
        }

        $responseToUser = '';

        foreach ($orders as $item) {
            $responseToUser .= $item['orderId']
                .' - '.$item['totalCost'].'р.'
                .PHP_EOL
                .$item['status']['status'].' | '
                .$item['status']['payment'].' | '
                .$item['status']['delivey']
                .PHP_EOL
//                .'-------------------------'
                .PHP_EOL;
        }

        Yii::info([
            'action'=>'debug',
            'updateId'=>$this->request['update_id'],
            '$orders'=>$orders,
            '$responseToUser'=>$responseToUser,
        ], 'b2bBot');




        $this->sendMessageWithBody([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => $responseToUser,
            'reply_markup' => Json::encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>'Подробнее о заказе','switch_inline_query_current_chat'=> '/order_details'],
                        ['text'=>'Опции', 'callback_data'=> '/options'],
                    ],
                ]
            ]),
        ]);
        return ['message' => 'ok', 'code' => 200];
    }




    private function getOneProductFromServer($options = [])
    {
        $jsonResponse = $this->sendToServer(Yii::$app->params['b2bServerPathProdProduct'], $options);
        return Json::decode($jsonResponse);
    }


    private function getSearchResultsFromServer($options = [])
    {
        $jsonResponse = $this->sendToServer(Yii::$app->params['b2bServerPathProdProducts'], $options);
        return Json::decode($jsonResponse);
    }


    private function getOrderFromServer($options = [])
    {
        $jsonResponse = $this->sendToServer(Yii::$app->params['b2bServerPathProdOrder'], $options);
        return Json::decode($jsonResponse);
    }


    private function getOrdersFromServer($options = [])
    {
        $jsonResponse = $this->sendToServer(Yii::$app->params['b2bServerPathProdLastOrders'], $options);
        return Json::decode($jsonResponse);
    }


    private function sendToServer($url, $options = [])
    {
        $options['apiKey']= Yii::$app->params['b2bServerApiKey'];
        $optQuery = http_build_query($options);
        $ch = curl_init($url.'?'.$optQuery);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
        curl_setopt($ch, CURLOPT_ENCODING,'gzip,deflate');
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 25);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if (count($options)) {
            curl_setopt($ch, CURLOPT_POST, true); // Content-Type: application/x-www-form-urlencoded' header.
        }
        $r = curl_exec($ch);

        if($r == false){
            $text = 'curl error '.curl_error($ch);
            Yii::info($text, 'b2bBot');
            return $text;
        } else {
            $info = curl_getinfo($ch);
            $info['url'] = str_replace(Yii::$app->params['b2bServerApiKey'],'_not_logged_',  $info['url']);
            $options['apiKey']='_not_logged_';
            $info = [
                    'action'=>'curl to Server',
                    'options'=>$options,
                ] + $info;
            Yii::info($info, 'b2bBot');
            if ($info['http_code'] == 500) {
                $serverError = [];
                $serverError['error'] = 1;
                $serverError['message'] = 'Извините, на сервере технические проблемы.'
                    .PHP_EOL .'В данный момент запрос не может быть обработан';
                $serverError['code'] = 500;
                curl_close($ch);
                return Json::encode($serverError);
            }
        }
        curl_close($ch);
        return $r;
    }



    /**
     *   @var array
     *   $this->answerCallbackQuery([
     *       'callback_query_id' => '3343545121', //require
     *       'text' => 'text', //Optional
     *       'show_alert' => 'my alert',  //Optional
     *   ]);
     *   The answer will be displayed to the user as a notification at the top of the chat screen or as an alert.
     *  On success, True is returned.
     */
    public function answerCallbackQuery(array $options = [])
    {
        $jsonResponse = $this->sendToUser('https://api.telegram.org/bot' .
            Yii::$app->params['b2bBotToken'] .
            '/answerCallbackQuery', $options);
        return Json::decode($jsonResponse);
    }
    /**
     *   @var array
     *   sample
     *   $this->answerInlineQuery([
     *       'inline_query_id' => Integer,
     *       'user' => User, //Optional
     *   ]);
     *
     */
    public function answerInlineQuery(array $options = [])
    {
        $jsonResponse = $this->sendToUser('https://api.telegram.org/bot' .
            Yii::$app->params['b2bBotToken'] .
            '/answerInlineQuery', $options, true);
        return Json::decode($jsonResponse);
    }

    /**
     *   @var array
     *   аргументы
     *  массив опций
     *
     */
    public function sendMessageWithBody(array $options)
    {
        $this->request['answer'] = $options['text'];
        $this->request['answer_time'] = time();
        $this->request->save();
        $chat_id = $options['chat_id'];
        $urlEncodedText = urlencode($options['text']);
        $jsonResponse = $this->sendToUser('https://api.telegram.org/bot' .
            Yii::$app->params['b2bBotToken'].
            '/sendMessage?chat_id='.$chat_id .
            '&text='.$urlEncodedText, $options, true);
        return Json::decode($jsonResponse);
    }

    /**
     *   @var array
     *   аргументы
     * 1 массив опций
     * 2 флаг отправки информации в теле запроса (кнопы )
     *
     */
    public function sendMessage(array $options, $dataInBody = false)
    {
        $this->request['answer'] = $options['text'];
        $this->request['answer_time'] = time();
        $this->request->save();
        $chat_id = $options['chat_id'];
        $urlEncodedText = urlencode($options['text']);
        $jsonResponse = $this->sendToUser('https://api.telegram.org/bot' .
            Yii::$app->params['b2bBotToken'].
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
            $info['url'] = str_replace(Yii::$app->params['b2bBotToken'],'_not_logged_',  $info['url']);
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

    private function sendErrorMessage ($error){
        $this->sendMessageWithBody([
            'chat_id' => $this->user['telegram_user_id'],
            'text' => $error,
            'reply_markup' => Json::encode([
                'inline_keyboard'=>[
                    [
                        ['text'=>'Опции', 'callback_data'=> '/options'],
                    ],
                ]
            ]),
        ]);
        return ['message' => 'ok', 'code' => 200];
    }

    private function sendErrorInline($error, $inlineQueryId){
        $result = [];
        $result[] = [
            'type' => 'article',
            'id' => '1',
            'title' => 'Ошибка соединения',
            'description' => $error,
            'input_message_content'=>[
                'message_text'=> '/options',
                'parse_mode'=> 'html',
                'disable_web_page_preview'=> true,
            ],
        ];

        $this->answerInlineQuery([
            'inline_query_id' => $inlineQueryId,
            'is_personal' => true,
            'results'=> Json::encode($result)
        ]);
        return ['message' => 'ok', 'code' => 200];
    }






}
//
