<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_section_block_item`.
 */
class m200112_124348_create_article_section_block_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('article_section_block_item', [
            'id' => $this->primaryKey(),
            'article_section_block_id'=> $this->integer()->notNull(),
            'sort' => $this->integer(),
            'code_name' => $this->string(),
            'header'=>$this->string(510),
            'header_class'=>$this->string(),
            'description'=>$this->text(),
            'description_class'=>$this->string(),
            'text'=>$this->text(),
            'text_class'=>$this->string(),
            'comment'=>$this->text(),
            'comment_class'=>$this->string(),
            'image'=>$this->text(),
            'image_alt'=>$this->string(),
            'image_title'=>$this->text(),
            'image_class'=>$this->string(),
            'link_description'=>$this->string(510),
            'link_name'=>$this->string(),
            'link_url'=>$this->string(),
            'link_class'=>$this->string(),
            'link_comment'=>$this->string(),
            'view'=>$this->string(),
            'color_key'=>$this->string(),
            'structure'=>$this->string(),
            'accent'=>$this->boolean(),
            'custom_class'=>$this->string(),
            'type'=>$this->string(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->addForeignKey(
            'fk_article_section_block_item_to_block',
            'article_section_block_item','article_section_block_id',
            'article_section_block','id',
            'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey( 'fk_article_section_block_item_to_block','article_section_block_item');
        $this->dropTable('article_section_block_item');
    }
}
