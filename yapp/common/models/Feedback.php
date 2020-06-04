<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\httpclient\Client;
use yii\web\BadRequestHttpException;


/**
 * This is the model class for table "feedback".
 *
 * @property int $id
 * @property string $user_id
 * @property string $name
 * @property string $city
 * @property string $master_id
 * @property string $session_type
 * @property string $phone
 * @property string $email
 * @property string $contacts
 * @property string $text
 * @property string $date
 * @property int $done
 * @property int $type
 *
 */
class Feedback extends \yii\db\ActiveRecord
{
//    public $emailForSend;
//    public $emailForSend = 'quadrosh@gmail.com';

    const TYPE_TO_PSIHOTERA = 100;
    const TYPE_TO_MASTER = 101;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'feedback';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'date',
                'updatedAtAttribute' => false,
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [
                [
                    'done',
                    'send_time',
                    'date',
                    'type',
                ], 'integer'
            ],
            [['text'], 'string'],
            [['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'], 'string'],
            ['utm_source', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_medium', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_campaign', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_term', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            ['utm_content', 'filter', 'filter' => function ($value) {
                if (strlen($value)>=509) {
                    $newValue = substr($value,0,509);
                } else {
                    $newValue = $value;
                }
                return $newValue;
            }],
            [
                [
                    'user_id',
                    'city',
                    'master_id',
                    'phone',
                    'email',
                    'session_type',
                    'send_status',
                    'contacts'
                ], 'string', 'max' => 255
            ],
            [['name', ], 'string', 'max' => 100],
            [['name', 'phone'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'user_id',
            'master_id' => 'Master ID',
            'phone' => 'Телефон',
            'name' => 'Имя',
            'city' => 'Город',
            'session_type' => 'Тип сессии',
            'utm_source' => 'UTM Source',
            'utm_medium' => 'UTM Medium',
            'utm_campaign' => 'UTM Campaign',
            'utm_term' => 'UTM Term',
            'utm_content' => 'UTM Content',
            'email' => 'Email',
            'contacts' => 'Контакты',
            'text' => 'Комментарий',
            'date' => 'Дата',
            'done' => 'Done',
            'send_time' => 'Время отправки',
            'send_status' => 'Статус отправки',
        ];
    }
    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($subject,$email)
    {

            return Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom('noreply@psihotera.ru')
                ->setSubject($subject)
                ->setHtmlBody(
                    "Данные запроса <br>".
                    " <br/> Тип сессии: ".$this->session_type .
                    " <br/> Имя: ".$this->name .
                    " <br/> Телефон: ".$this->phone .
                    " <br/> Комментарий: ".$this->text )
                ->send();

    }

    /**
     * @return bool whether the notification done successful
     */
    public function notifyAboutOrder()
    {
        if ($this->type == Feedback::TYPE_TO_MASTER) {
            $master = Master::findOne($this->master_id);

            $text = 'Поступила заявка:' . PHP_EOL;
            if ($this->phone) $text .= 'Телефон: '. $this->phone . PHP_EOL;
            if ($this->email) $text .= 'email: '. $this->email . PHP_EOL;
            if ($this->name) $text .= 'Имя: '. $this->name . PHP_EOL;
            if ($this->city) $text .= 'Город: '. $this->city . PHP_EOL;
            if ($this->session_type) $text .= 'Тип сессии: '. $this->session_type . PHP_EOL;
            if ($this->contacts) $text .= 'Контакты: '. $this->contacts . PHP_EOL;
            if ($this->text) $text .= 'Комментарий: '. $this->text . PHP_EOL;



            if ($master->order_messenger == Master::ORDER_MESSENGER_TYPE_EMAIL) {
                if (!$master->sendEmailNotification( 'Заявка psihotera.ru',$text)) {
                    Yii::$app->session->addFlash('error', 'Ошибка отправки email оповещения');
                } else {
                    Yii::$app->session->addFlash('success', 'email оповещение отправлено');
                }
            }

            if ($master->order_sms_enable == Master::ORDER_BY_SMS_ENABLE) {
                if (!$this->sendSmsOrderNotification()) {
                    Yii::$app->session->addFlash('error', 'Ошибка отправки sms оповещения');
                } else {
                    Yii::$app->session->addFlash('success', 'sms оповещение отправлено');
                }
            }

            return true;
        } else {
            $text = 'Поступила заявка:' . PHP_EOL;
            if ($this->phone) $text .= 'Телефон: '. $this->phone . PHP_EOL;
            if ($this->email) $text .= 'email: '. $this->email . PHP_EOL;
            if ($this->name) $text .= 'Имя: '. $this->name . PHP_EOL;
            if ($this->city) $text .= 'Город: '. $this->city . PHP_EOL;
            if ($this->session_type) $text .= 'Тип сессии: '. $this->session_type . PHP_EOL;
            if ($this->contacts) $text .= 'Контакты: '. $this->contacts . PHP_EOL;
            if ($this->text) $text .= 'Комментарий: '. $this->text . PHP_EOL;



            if (!$this->notifyAdminByEmail( 'Заявка psihotera.ru',$text)) {
                Yii::$app->session->addFlash('error', 'Ошибка отправки email оповещения');
            } else {
                Yii::$app->session->addFlash('success', 'email оповещение отправлено');
            }


            if (!$this->sendSmsOrderNotification()) {
                Yii::$app->session->addFlash('error', 'Ошибка отправки sms оповещения');
            } else {
                Yii::$app->session->addFlash('success', 'sms оповещение отправлено');
            }

        }


    }

    /**
     * мастер
     */
    public function getMaster()
    {
        return $this->hasOne(Master::class,['id'=>'master_id']);
    }


    private function sendSmsOrderNotification()
    {

        //todo счетчик SMS


        if (YII_ENV == 'dev' || YII_ENV == 'DEV' ) {
            Yii::$app->session->addFlash('success', 'SMS не отправлено, сайт на техосмотре.');
            return false;
        }

        $httpClient = new Client();

        if ($this->type == Feedback::TYPE_TO_PSIHOTERA) {
            $text = 'Psihotera'.$this->master_id.' - заявка, имя - '.$this->name.', телефон - '.$this->phone;
            $response = $httpClient->createRequest()
                ->setMethod('post')
                ->setUrl('https://sms.ru/sms/send')
                ->setData([
                    'api_id' => Yii::$app->params['sms_api_id'],
                    'to' => Yii::$app->params['adminPhone'],
                    'text'=> $text,
                ])
                ->send();
            if ($response->isOk) {
                return true;
            } else {
                return false;
            }
        } else { //  sms мастеру

            if (!$this->master->order_phone) {
                Yii::$app->session->addFlash('error', 'Не заполнено поле "master->order_phone"');
                return false;
            }
            $text = 'Psihotera'.$this->master_id.' - заявка с сайта, имя - '.$this->name.', телефон - '.$this->phone;
            $response = $httpClient->createRequest()
                ->setMethod('post')
                ->setUrl('https://sms.ru/sms/send')
                ->setData([
                    'api_id' => Yii::$app->params['sms_api_id'],
                    'to' => Yii::$app->params['adminPhone'].', '.$this->master->order_phone,
                    'text'=> $text,
                ])
                ->send();
            if ($response->isOk) {
                return true;
            } else {
                return false;
            }
        }


    }


    public  function notifyAdminByEmail($subject,$text,$link=null,$linkName=null){
        Yii::$app->mailer->htmlLayout = "layouts/montserrat";
        $mailer = Yii::$app->mailer->compose('notification', [
            'name' => 'ПСИХОТЕРА',
            'text'=>$text,
            'link'=>$link,
            'linkName'=>$linkName,
        ]);
        return $mailer->setFrom([Yii::$app->params['noreplyEmail']=>Yii::$app->params['noreplyName']])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject($subject)
            ->send();
    }

}

