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
 * @property integer $created_at
 * @property integer $updated_at
 */
class Master extends \yii\db\ActiveRecord
{
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
    public function getAssigns()
    {
        return $this->hasMany(ItemAssign::className(), ['master_id' => 'id']);
    }
    public function getPros()
    {
        return $this->hasMany(ProfessionItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'pro']);
            });
    }
    public function getPsys()
    {
        return $this->hasMany(PsychotherapyItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'psy']);
            });
    }
    public function getSites()
    {
        return $this->hasMany(SiteItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['master_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'site']);
            });
    }
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hrurl'],'unique'],
            [['username'], 'required'],
            [['other_contacts', 'comment', 'hello'], 'string'],
            [['site_id', 'created_at', 'updated_at'], 'integer'],
            [['username', 'hrurl', 'name', 'middlename', 'surname', 'image', 'city', 'phone', 'address', 'email', 'stylekey', 'view', 'layout', 'status'], 'string', 'max' => 255],
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
            'background_image' => 'Background Image',
            'stylekey' => 'Stylekey',
            'hello' => 'Hello',
            'view' => 'View',
            'layout' => 'Layout',
            'list_add' => 'List Add',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public static function find()
    {
        return new MasterQuery(get_called_class());
    }
}
