<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_section_block_item".
 *
 * @property int $id
 * @property int $article_section_block_id
 * @property int $sort
 * @property string $code_name
 * @property string $header
 * @property string $header_class
 * @property string $description
 * @property string $description_class
 * @property string $text
 * @property string $text_class
 * @property string $comment
 * @property string $comment_class
 * @property string $image
 * @property string $image_alt
 * @property string $image_class
 * @property string $link_description
 * @property string $link_name
 * @property string $link_url
 * @property string $link_class
 * @property string $link_comment
 * @property string $view
 * @property string $color_key
 * @property string $structure
 * @property int $accent
 * @property string $custom_class
 * @property string $type
 * @property int $created_at
 * @property int $updated_at
 * @property string $image_title
 */
class ArticleSectionBlockItem extends \yii\db\ActiveRecord
{
    const VIEW_OPTIONS = [
        '_asbi-img_link_description' => '| img_link_description',
        '_asbi-header_on_img' => '| header_on_img',
        '_asbi-v_svg_head_text' => '| svg_head_text',
        '_asbi-v_img_head_text' => '| img_head_text',
        '_asbi-h_img_icon_in_head' => '-- img_icon_in_head',
        '_asbi-h_img_col-text_col' => '-- img_col-text_col',
        '_asbi-h_tbl2_img_head--text__w1-structure' => '-- tbl2_img_head--text__w1-structure',
        '_asbi-h_bs2-img_head--text' => '-- bs2-img_head--text',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_section_block_item';
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
            [['article_section_block_id'], 'required'],
            [['article_section_block_id', 'sort', 'accent', 'created_at', 'updated_at'], 'integer'],
            [['description', 'text', 'comment', 'image','image_title'], 'string'],
            [['code_name', 'header_class', 'description_class', 'text_class', 'comment_class', 'image_alt', 'image_class', 'link_name', 'link_url', 'link_class', 'link_comment', 'view', 'color_key', 'structure', 'custom_class', 'type'], 'string', 'max' => 255],
            [['header', 'link_description'], 'string', 'max' => 510],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'article_section_block_id' => 'Article Section Block ID',
            'sort' => 'Sort',
            'code_name' => 'Code Name',
            'header' => 'Header',
            'header_class' => 'Header Class',
            'description' => 'Description',
            'description_class' => 'Description Class',
            'text' => 'Text',
            'text_class' => 'Text Class',
            'comment' => 'Comment',
            'comment_class' => 'Comment Class',
            'image' => 'Image',
            'image_alt' => 'Image Alt',
            'image_class' => 'Image Class',
            'link_description' => 'Link Description',
            'link_name' => 'Link Name',
            'link_url' => 'Link Url',
            'link_class' => 'Link Class',
            'link_comment' => 'Link Comment',
            'view' => 'View',
            'color_key' => 'Color Key',
            'structure' => 'Structure',
            'accent' => 'Accent',
            'custom_class' => 'Custom Class',
            'type' => 'Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getBlock()
    {
        return $this->hasOne(ArticleSectionBlock::class,['id'=>'article_section_block_id']);
    }

    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        if ($this->image) {
            $this->deleteImage('image');
        }
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


    public function multiply($qnt)
    {
        $i = intval($qnt)-1 ;
        $iter=0;
        while ($i>0){
            $_model = new self();
            $_model->attributes = $this->attributes;
            $_model->save();
            if ($_model->save()) {
                $iter++;
            }
            $i--;

        }
        Yii::$app->session->addFlash('success', 'Создано '.$iter.' объектов.');

        return true;

    }
}
