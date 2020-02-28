<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "master".
 *
 * @property integer $id
 * @property string $username
 * @property string $hrurl
 * @property string $name
 * @property string $middlename
 * @property string $surname
 * @property string $image
 * @property string $image_alt
 * @property string $city
 * @property string $phone
 * @property string $other_contacts
 * @property string $address
 * @property string $email
 * @property string $site_link
 * @property integer $site_id
 * @property string $comment
 * @property string $background_image
 * @property string $stylekey
 * @property string $hello
 * @property string $view
 * @property string $layout
 * @property string $list_add
 * @property string $status
 * @property string $order_view
 * @property string $order_messenger
 * @property string $order_messenger_id
 * @property string $order_phone
 * @property string $order_sms_enable
 * @property integer $order_sms_count
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $root
 */
class Master extends \yii\db\ActiveRecord
{

    const HRURL_AIGUL_SHE = 'she';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hrurl'],'unique'],
            [['username'], 'required'],
            [['other_contacts', 'comment', 'hello'], 'string'],
            [
                [
                    'site_id',
                    'created_at',
                    'order_sms_count',
                    'updated_at'
                ], 'integer'
            ],
            [
                [
                    'username',
                    'hrurl',
                    'name',
                    'middlename',
                    'surname',
                    'image',
                    'city',
                    'phone',
                    'address',
                    'email',
                    'stylekey',
                    'view',
                    'layout',
                    'status',
                    'order_view',
                    'order_messenger',
                    'order_messenger_id',
                    'order_phone',
                    'order_sms_enable',
                    'root',
                ], 'string', 'max' => 255
            ],
            [['image_alt', 'site_link', 'background_image', 'list_add'], 'string', 'max' => 510],
            [['username'], 'unique'],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'ФИО',
            'hrurl' => 'Hrurl',
            'root' => 'Root',
            'name' => 'Имя',
            'middlename' => 'Отчество',
            'surname' => 'Фамилия',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'city' => 'Город',
            'phone' => 'Phone',
            'other_contacts' => 'Other Contacts',
            'address' => 'Address',
            'email' => 'Email',
            'site_link' => 'Site Link',
            'site_id' => 'Site ID',
            'comment' => 'Comment',
            'background_image' => 'Background Image on masterpage',
            'stylekey' => 'Stylekey',
            'hello' => 'Приветствие на странице мастера',
            'view' => 'View',
            'layout' => 'Layout',
            'list_add' => 'Добавочный текст в списке (помошь в проблемах...)',
            'status' => 'Status',
            'order_phone' => 'Order Phone',
            'order_view' => 'Order View',
            'order_messenger' => 'Order Messenger',
            'order_messenger_id' => 'Order Messenger ID',
            'order_sms_enable' => 'Order SMS Статус',
            'order_sms_count' => 'Order SMS Осталось',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'fio' => '_ФИО (в разработке)',
        ];
    }

//    public static function find()
//    {
//        return new MasterQuery(get_called_class());
//    }



    /**
     * Профессии
     */
    public function getPros()
    {
        return $this->hasMany(ProfessionItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'pro']);
            });
    }

    /**
     * Виды психотерапии
     */
    public function getPsys()
    {
        return $this->hasMany(PsychotherapyItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'psy']);
            });
    }

    /**
     * Сайты
     */
    public function getSites()
    {
        return $this->hasMany(SiteItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'site']);
            });
    }

    /**
     * Кнопки
     */
    public function getBtns()
    {
        return $this->hasMany(BtnItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'btn']);
            });
    }
    public function getMtexts()
    {
        return $this->hasMany(Article::className(),['master_id'=>'id'])->where(['link2original'=>'masterpage','status'=>'publish']);

    }

    /**
     * Города
     */
    public function getCities()
    {
        return $this->hasMany(CityItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'city']);
            });
    }

    /**
     * Назначения
     */
    public function getAssigns()
    {
        return $this->hasMany(ItemAssign::className(), ['master_id' => 'id']);
    }



    public function getSessionAssighs()
    {
        return $this->getAssigns()->where(['item_type'=>'session'])->all();
    }

    /**
     * Виды приема
     */
    public function getSessionTypes()
    {
        return $this->hasMany(SessionTypeItem::className(),['id'=>'item_id'])
            ->via('assigns',function($q){
                $q->andWhere(['item_type'=>'session']);
            })
//        return $this->hasMany(SessionTypeItem::className(),['id'=>'item_id'])
//            ->viaTable('item_assign',['master_id'=>'id'],function($query){
//                $query->andWhere(['item_type'=>'session']);
//            });





//            ->joinWith(['assigns']);

//         return $this->hasMany(SessionTypeItem::className(),['id'=>'item_id'])
//            ->viaTable('item_assign',['master_id'=>'id'],function($q){
//                $q->andWhere(['item_type'=>'session']);
//            })
//             ->leftJoin('item_assign', 'item_assign.master_id='.$this['id'].' AND item_assign.item_type="session"')
//             ->rightJoin('item_assign', 'item_assign.master_id='.$this['id'].' AND item_assign.item_type="session"')
//             ->innerJoin('item_assign', 'item_assign.master_id='.$this['id'].' AND item_assign.item_type="session"')

//             ->asArray()
            ;
    }

    /**
     * Метки
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(),['id'=>'tag_id'])
            ->viaTable('tag_assign',['master_id'=>'id']);
    }

    /**
     * image cloud
     */
    public function getImagefile()
    {
        return $this->hasOne(Imagefiles::className(),['name'=>'image']);
    }

    /**
     * Background image cloud
     */
    public function getBackgroundImagefile()
    {
        return $this->hasOne(Imagefiles::className(),['name'=>'background_image']);
    }



    public function getFio(){
        return $this['name'].' '.$this['middlename'].' '.$this['surname'];
    }



}
