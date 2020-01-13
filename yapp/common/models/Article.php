<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $list_name
 * @property integer $list_num
 * @property string $hrurl
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $text
 * @property string $excerpt
 * @property string $pagehead
 * @property string $topimage
 * @property string $promolink
 * @property string $promoname
 * @property string $imagelink
 * @property string $imagelink_alt
 * @property string $link2original
 * @property string $author
 * @property integer $master_id
 * @property string $status
 * @property string $type
 * @property string $topimage_title
 * @property string $background_image
 * @property string $background_image_title
 * @property string $thumbnail_image
 * @property string $thumbnail_image_alt
 * @property string $thumbnail_image_title
 * @property string $call2action_description
 * @property string $call2action_name
 * @property string $call2action_link
 * @property string $call2action_class
 * @property string $call2action_comment
 * @property string $object_type
 * @property integer $object_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class Article extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 'publish';
    const STATUS_IN_PROCESS = 'in_process';
    const STATUS_UNREAD = 'unread';


    const TYPE_ARTICLE = 'article';
    const TYPE_MASTER_TEXT = 'master_text';
    const TYPE_PAGE = 'page';

    const OBJECT_TYPE_MASTER = 'master';




    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public function behaviors()
    {
        return [
            [
                'class' => \yii\behaviors\TimestampBehavior::class,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hrurl'],'unique'],
            [[
                'list_num',
                'master_id',
                'object_id',
                'created_at',
                'updated_at',
            ], 'integer'],
            [[
                'description',
                'keywords',
                'text',
                'excerpt',
                'excerpt_big',
                'topimage_title',
                'background_image',
                'background_image_title',
                'thumbnail_image',
                'thumbnail_image_title',
            ], 'string'],
            [[
                'view',
                'layout',
                'list_name',
                'hrurl',
                'title',
                'pagehead',
                'topimage',
                'promolink',
                'promoname',
                'imagelink',
                'imagelink_alt',
                'author',
                'status',
                'topimage_alt',
                'type',
                'thumbnail_image_alt',
                'call2action_name',
                'call2action_link',
                'call2action_class',
                'call2action_comment',
                'object_type',

            ], 'string', 'max' => 255],
            [[
                'link2original',
                'call2action_description',
            ], 'string', 'max' => 510],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'list_name' => 'List Name (mt)',
            'list_num' => 'List Num (mt)',
            'hrurl' => 'Hrurl (mt)',
            'title' => 'Title',
            'description' => 'Description',
            'keywords' => 'Keywords',
            'pagehead' => 'Pagehead (mt)',
            'text' => 'Text (mt)',
            'excerpt' => 'Excerpt',
            'excerpt_big' => 'Excerpt Big',
            'topimage' => 'Topimage',
            'topimage_alt' => 'Topimage Alt',
            'promolink' => 'Promolink',
            'promoname' => 'Promoname',
            'imagelink' => 'Imagelink',
            'imagelink_alt' => 'Imagelink Alt',
            'link2original' => 'Link2original (mt)',
            'view' => 'View',
            'layout' => 'Layout',
            'author' => 'Author',
            'master_id' => 'Master ID (mt)',
            'status' => 'Status (mt)',
        ];
    }

    static public function cyrillicToLatin($text, $maxLength, $toLowCase)
    {
        $dictionary = array(
            'й' => 'i',
            'ц' => 'c',
            'у' => 'u',
            'к' => 'k',
            'е' => 'e',
            'н' => 'n',
            'г' => 'g',
            'ш' => 'sh',
            'щ' => 'shch',
            'з' => 'z',
            'х' => 'h',
            'ъ' => '',
            'ф' => 'f',
            'ы' => 'y',
            'в' => 'v',
            'а' => 'a',
            'п' => 'p',
            'р' => 'r',
            'о' => 'o',
            'л' => 'l',
            'д' => 'd',
            'ж' => 'zh',
            'э' => 'e',
            'ё' => 'e',
            'я' => 'ya',
            'ч' => 'ch',
            'с' => 's',
            'м' => 'm',
            'и' => 'i',
            'т' => 't',
            'ь' => '',
            'б' => 'b',
            'ю' => 'yu',

            'Й' => 'I',
            'Ц' => 'C',
            'У' => 'U',
            'К' => 'K',
            'Е' => 'E',
            'Н' => 'N',
            'Г' => 'G',
            'Ш' => 'SH',
            'Щ' => 'SHCH',
            'З' => 'Z',
            'Х' => 'X',
            'Ъ' => '',
            'Ф' => 'F',
            'Ы' => 'Y',
            'В' => 'V',
            'А' => 'A',
            'П' => 'P',
            'Р' => 'R',
            'О' => 'O',
            'Л' => 'L',
            'Д' => 'D',
            'Ж' => 'ZH',
            'Э' => 'E',
            'Ё' => 'E',
            'Я' => 'YA',
            'Ч' => 'CH',
            'С' => 'S',
            'М' => 'M',
            'И' => 'I',
            'Т' => 'T',
            'Ь' => '',
            'Б' => 'B',
            'Ю' => 'YU',

            '\-' => '-',
            '\s' => '-',

            '[^a-zA-Z0-9\-]' => '',

            '[-]{2,}' => '-',
        );

        foreach ($dictionary as $from => $to)
        {
            $text = mb_ereg_replace($from, $to, $text);
        }

        $text = mb_substr($text, 0, $maxLength, Yii::$app->charset);
        if ($toLowCase)
        {
            $text = mb_strtolower($text, Yii::$app->charset);
        }

        return trim($text, '-');
    }

    static public function excerpt($text, $maxLength)
    {
        $cutDirtyText = substr($text, 0, $maxLength*3);
        $stripTaggedText = strip_tags($cutDirtyText);
        $cleanText = preg_replace("/&#?[a-z0-9]{2,8};/i"," ",$stripTaggedText);
        error_reporting(E_ALL ^ E_WARNING);
        $endPosition = strpos($cleanText, ' ', $maxLength);
        if ($endPosition !== false) {
            return substr($cleanText, 0, $endPosition);
        } else {
            return $text;
        }
    }

    static public function firstLetters($id)
    {
        $article = Article::find()->where(['id'=>$id])->one();
        $author = '';
        if ($article['author']!=null) {
            $author = $article['author'];
        } else {
//            $master = $article->master;
//            $master = Master::find()->where(['id'=>$article['master_id']])->one();
            $author = $article->master['username'];
        }

        $latin = Article::cyrillicToLatin($author, 210, true);
        $words = explode("-", $latin);
        $abbr = '';
        foreach ($words as $word) {
            $abbr .=$word[0];
        }
        return $abbr;
    }
    static public function latinAuthor($id)
    {
        $article = Article::find()->where(['id'=>$id])->one();
        $author = '';
        if ($article['author']!=null) {
            $author = $article['author'];
        } else {
            $author = $article->master['username'];
        }

        $latin = Article::cyrillicToLatin($author, 210, true);

        return $latin;
    }
    /**
     * top image
     */
    public function getTopimagefile()
    {
        return $this->hasOne(Imagefiles::className(),['name'=>'topimage']);
    }

    /**
     * мастер
     */
    public function getMaster()
    {
        return $this->hasOne(Master::className(),['id'=>'master_id']);
    }
    /**
     * метки
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(),['id'=>'tag_id'])
            ->viaTable('tag_assign',['article_id'=>'id']);
    }

    /**
     * Направления психотерапии
     */
    public function getPsys()
    {
        return $this->hasMany(PsychotherapyItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['article_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'psy']);
            });
    }

    /**
     * Сайт
     */
    public function getSites()
    {
        return $this->hasMany(SiteItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['article_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'site']);
            });
    }

    /**
     * Города
     */
    public function getCities()
    {
        return $this->hasMany(CityItem::className(),['id'=>'item_id'])
            ->viaTable('item_assign',['article_id'=>'id'],function($query){
                $query->andWhere(['item_type'=>'city']);
            });
    }

    public function getSections()
    {
        return $this->hasMany(ArticleSection::class,['article_id'=>'id'])->orderBy(['sort' => SORT_ASC]);
    }
}
