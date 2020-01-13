<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_section".
 *
 * @property int $id
 * @property int $article_id
 * @property int $sort
 * @property string $code_name
 * @property string $header
 * @property string $header_class
 * @property string $description
 * @property string $description_class
 * @property string $raw_text
 * @property string $raw_text_class
 * @property string $conclusion
 * @property string $conclusion_class
 * @property string $image
 * @property string $image_alt
 * @property string $image_class
 * @property string $background_image
 * @property string $thumbnail_image
 * @property string $call2action_description
 * @property string $call2action_name
 * @property string $call2action_link
 * @property string $call2action_class
 * @property string $call2action_comment
 * @property string $view
 * @property string $color_key
 * @property string $structure
 * @property string $custom_class
 * @property int $created_at
 * @property int $updated_at
 * @property string $image_title
 * @property string $background_image_title
 * @property string $thumbnail_image_alt
 * @property string $thumbnail_image_title
 */
class ArticleSection extends \yii\db\ActiveRecord
{
    const VIEW_OPTIONS = [
        '_as-default' => 'default',
        '_as-full_width' => 'full_width',
        '_as-h1_head' => 'h1_head',
        '_as-head-descr-blocks-text' => 'head-descr-blocks-text',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_section';
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id'], 'required'],
            [['article_id', 'sort', 'created_at', 'updated_at'], 'integer'],
            [['description', 'raw_text', 'conclusion', 'image', 'background_image', 'thumbnail_image',
                'image_title','background_image_title','thumbnail_image_title'], 'string'],
            [['code_name', 'header_class', 'description_class', 'raw_text_class', 'conclusion_class', 'image_alt', 'image_class', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'view', 'color_key', 'structure', 'custom_class', 'thumbnail_image_alt'], 'string', 'max' => 255],
            [['header', 'call2action_description'], 'string', 'max' => 510],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article ID',
            'sort' => 'Sort',
            'code_name' => 'Code Name',
            'header' => 'Header',
            'header_class' => 'Header Class',
            'description' => 'Description',
            'description_class' => 'Description Class',
            'raw_text' => 'Raw Text',
            'raw_text_class' => 'Raw Text Class',
            'conclusion' => 'Conclusion',
            'conclusion_class' => 'Conclusion Class',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'image_class' => 'Image Class',
            'background_image' => 'Background Image',
            'thumbnail_image' => 'Thumbnail Image',
            'call2action_description' => 'Call2action Description',
            'call2action_name' => 'Call2action Name',
            'call2action_link' => 'Call2action Link',
            'call2action_class' => 'Call2action Class',
            'call2action_comment' => 'Call2action Comment',
            'view' => 'View',
            'color_key' => 'Color Key',
            'structure' => 'Structure',
            'custom_class' => 'Custom Class',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getArticle()
    {
        return $this->hasOne(Article::class,['id'=>'article_id']);
    }

    public function getBlocks()
    {
        return $this->hasMany(ArticleSectionBlock::class,['article_section_id'=>'id'])
            ->orderBy(['sort' => SORT_ASC]);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        if ($this->image) {
            $this->deleteImage('image');
        }
        if ($this->background_image) {
            $this->deleteImage('background_image');
        }
        if ($this->thumbnail_image) {
            $this->deleteImage('thumbnail_image');
        }
//        if ($this->blocks){
//            foreach ($this->blocks as $item) {
//                $item->delete();
//            }
//        }
        return true;
    }

    public function deleteImage($propertyName)
    {
        $imageFile = Imagefiles::find()->where(['name'=>$this->$propertyName])->one();
        if ($imageFile) {
            $imageFile->delete();
        }
        $this->$propertyName = null;
        $this->save();
    }


    public static function moveUpBySort($id)
    {
        $model = static::findOne($id);

        $siblings = ArticleSection::find()->where([
            'article_id'=>$model->article_id
        ])->orderBy(['sort'=>SORT_ASC])->all();


        if (count($siblings)>1) {
            foreach ($siblings as $key => $child) {
                if ($child['id'] == $id && $key > 0) {
                    $item = $child;
                    $siblings[$key] = $siblings[$key-1];
                    $siblings[$key-1] = $item;
                }
            }
            foreach ($siblings as $key => $child) {
                $child->sort = $key+1;
                $child->save();
            }
        }
    }

    public static function moveDownBySort($id)
    {
        $model = static::findOne($id);

        $siblings = ArticleSection::find()->where([
            'article_id'=>$model->article_id
        ])->orderBy(['sort'=>SORT_ASC])->all();


        if (count($siblings)>1) {
            foreach ($siblings as $key => $child) {
                if ($child['id'] == $id && $key < count($siblings)-1) {
                    $item = $child;
                    $siblings[$key] = $siblings[$key+1];
                    $siblings[$key+1] = $item;
                }
            }
            foreach ($siblings as $key => $child) {
                $child->sort = $key+1;
                $child->save();
            }
        }
    }
}
