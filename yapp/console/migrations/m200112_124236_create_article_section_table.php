<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_section`.
 */
class m200112_124236_create_article_section_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_section', [
            'id' => $this->primaryKey(),
            'article_id'=> $this->integer()->notNull(),
            'sort' => $this->integer(),
            'code_name'=>$this->string(),
            'header'=>$this->string(510),
            'header_class'=>$this->string(),
            'description'=>$this->text(),
            'description_class'=>$this->string(),
            'raw_text'=>$this->text(),
            'raw_text_class'=>$this->string(),
            'conclusion'=>$this->text(),
            'conclusion_class'=>$this->string(),
            'image'=>$this->text(),
            'image_alt'=>$this->string(),
            'image_title'=>$this->text(),
            'image_class'=>$this->string(),
            'background_image'=>$this->text(),
            'background_image_title'=>$this->text(),
            'thumbnail_image'=>$this->text(),
            'thumbnail_image_alt'=>$this->string(),
            'thumbnail_image_title'=>$this->text(),
            'call2action_description'=>$this->string(510),
            'call2action_name'=>$this->string(),
            'call2action_link'=>$this->string(),
            'call2action_class'=>$this->string(),
            'call2action_comment'=>$this->string(),
            'view'=>$this->string(),
            'color_key'=>$this->string(),
            'structure'=>$this->string(),
            'custom_class'=>$this->string(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk_article_section_to_article',
            'article_section','article_id',
            'article','id',
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey( 'fk_article_section_to_article','article_section');
        $this->dropTable('article_section');
    }
}
