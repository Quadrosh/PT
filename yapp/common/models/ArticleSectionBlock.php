<?php

namespace common\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "article_section_block".
 *
 * @property int $id
 * @property int $article_section_id
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
 * @property int $accent
 * @property string $custom_class
 * @property int $created_at
 * @property int $updated_at
 * @property string $image_title
 * @property string $background_image_title
 * @property string $thumbnail_image_alt
 * @property string $thumbnail_image_title
 */
class ArticleSectionBlock extends \yii\db\ActiveRecord
{
    const VIEW_OPTIONS = [
        '_asb-bs_horiz_4' => 'bs_horiz_4',
        '_asb-bs_horiz_3' => 'bs_horiz_3',
        '_asb-bs_horiz_2' => 'bs_horiz_2',
        '_asb-2col_specs' => '2col_specs',
        '_asb-slick_1' => 'slick_1',
        '_asb-slick_leadbox' => 'slick_leadbox',
        '_asb-slick_banner_1' => 'slick_banner_1',
        '_asb-slick_carousel' => 'slick_carousel',
        '_asb-slick_vertical' => 'slick_vertical',
        '_asb-slick_small_horiz' => 'slick_small_horiz',
        '_asb-ul-li' => 'ul-li',
        '_asb-ol-li' => 'ol-li',
        '_asb-check_rates' => 'check_rates',
        '_asb-check_rates_room' => 'check_rates_room',
        '_asb-order_form_on_house' => 'order_form_on_house',
        '_asb-default' => 'default',

    ];
    const TEXT_CLASS_OPTIONS = [
        'text-center',
        'text-left',
        'text-right',
        'text-uppercase',
        'strong',
        'text-center strong',
        'text-center line-top line-bottom',
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_section_block';
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
            [['article_section_id'], 'required'],
            [['article_section_id', 'accent', 'created_at', 'updated_at','sort'], 'integer'],
            [['description', 'raw_text', 'conclusion', 'image', 'background_image', 'thumbnail_image',
                'image_title','background_image_title','thumbnail_image_title'], 'string'],
            [['code_name', 'header_class', 'description_class', 'raw_text_class', 'conclusion_class', 'image_alt', 'image_class', 'call2action_name', 'call2action_link', 'call2action_class', 'call2action_comment', 'view', 'color_key', 'structure', 'custom_class','thumbnail_image_alt'], 'string', 'max' => 255],
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
            'article_section_id' => 'Article Section ID',
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
            'accent' => 'Accent',
            'custom_class' => 'Custom Class',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getSection()
    {
        return $this->hasOne(ArticleSection::class,['id'=>'article_section_id']);
    }

    public function getItems()
    {
        return $this->hasMany(ArticleSectionBlockItem::class,['article_section_block_id'=>'id'])
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
//        if ($this->items){
//            foreach ($this->items as $item) {
//                $item->delete();
//            }
//        }
        return true;
    }



    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $section = $this->section;
            $article = $section->article;
            $article->updated_at = time();
            $article->save();

            if ($this->isNewRecord) {
                if (!$this->sort ) {
                    $count = count($section->blocks);
                    if ($count > 0) {
                        $this->sort = $count+1;
                    } else {
                        $this->sort = 1;
                    }
                }
            }
            return true;
        }
        return false;
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

    public function rawTextToItems( $mode = 1)
    {
        $text = $this->raw_text;
//        $arr = explode('<br />' , nl2br(trim($text)) );
        $arr = preg_split('/\r\n|\r|\n/',trim($text));



        if ($mode == 1) {
            $i=0;
            foreach ($arr as $string) {
                $blockItem = new ArticleSectionBlockItem();
                $blockItem->article_section_block_id = $this->id;

                $blockItem->text = $string;

                $blockItem->save();
                $i++;
            }
            $this->raw_text = null;
            $this->save();
            Yii::$app->session->setFlash('success', 'raw_text конвертирован в '.$i.' пунктов.');
            return true;
        }
        elseif ($mode == 2){
            $res=[];
            $tmp = [];
            $i=0;
            $iter=0;

            foreach ($arr as $string) {
                $i++;
                if (trim($string) == '') {
                    $i=0;
                    $iter ++;
                    $res[]=$tmp;
                    $tmp = [];
                } else {
                    if ($i == 1) {
                        $tmp['head'] = $string;
                        $tmp['text'] = '';
                    } else {
                        if ($i > 2) {
                            $tmp['text'] .= PHP_EOL;
                        }
                        $tmp['text'] .= $string;
                    }
                }
            }
            $res[]=$tmp;
            foreach ($res as $item) {
                $blockItem = new ArticleSectionBlockItem();
                $blockItem->article_section_block_id = $this->id;
                $blockItem->header = $item['head'];
                $blockItem->text = $item['text'];
                $blockItem->save();
            }
            $this->raw_text = null;
            $this->save();
            Yii::$app->session->setFlash('success', 'raw_text конвертирован в '.count($res).' пунктов.');
            return true;
        }

        else {

            return false;
        }

    }



    public static function moveUpBySort($id)
    {
        $model = static::findOne($id);
        if (!$model) throw new NotFoundHttpException('Не найден ArticleSectionBlockItem №'.$id);

        $siblings = ArticleSectionBlock::find()->where([
            'article_section_id'=>$model->article_section_id
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
        if (!$model) throw new NotFoundHttpException('Не найден ArticleSectionBlockItem №'.$id);

        $siblings = ArticleSectionBlock::find()->where([
            'article_section_id'=>$model->article_section_id
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
