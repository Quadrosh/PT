<?php

use yii\db\Migration;

class m191226_124806_alter_article_table extends Migration
{
    public function safeUp()
    {
        if ($this->db->getTableSchema('article', true) === null) {
            $this->createTable('article', [
                'id' => $this->primaryKey(),
                'list_name' => $this->string(255),
                'list_num' => $this->integer(),
                'hrurl' => $this->string(255),
                'title'=>$this->string(255),
                'description'=>$this->text(),
                'keywords'=>$this->text(),
                'text'=>$this->text(),
                'exerpt'=>$this->text(),
                'exerpt_big'=>$this->text(),
                'pagehead'=>$this->string(255),
                'topimage'=>$this->string(255),
                'topimage_alt'=>$this->string(255),
                'promolink'=>$this->string(255),
                'promoname'=>$this->string(255),
                'imagelink'=>$this->string(255),
                'imagelink_alt'=>$this->string(255),
                'link2original'=>$this->string(510),
                'author'=>$this->string(255),
                'master_id' => $this->integer(),
                'status'=>$this->string(255),
                'view'=>$this->string(255),
                'layout'=>$this->string(255),
                'type'=>$this->string(255),
                'topimage_title'=>$this->text(),
                'background_image'=>$this->text(),
                'background_image_title'=>$this->text(),

                'thumbnail_image'=>$this->text(),
                'thumbnail_image_alt'=>$this->string(255),
                'thumbnail_image_title'=>$this->text(),

                'call2action_description'=>$this->string(510),
                'call2action_name'=>$this->string(),
                'call2action_link'=>$this->string(),
                'call2action_class'=>$this->string(),
                'call2action_comment'=>$this->text(),
                'object_type'=>$this->string(),
                'object_id'=>$this->integer(),

                'created_at' => $this->integer(),
                'updated_at' => $this->integer(),
            ]);
        } else {
            $this->addColumn('article', 'type', $this->string());
            $this->addColumn('article', 'topimage_title', $this->text());
            $this->addColumn('article', 'background_image', $this->text());
            $this->addColumn('article', 'background_image_title', $this->text());
            $this->addColumn('article', 'thumbnail_image', $this->text());
            $this->addColumn('article', 'thumbnail_image_alt', $this->string());
            $this->addColumn('article', 'thumbnail_image_title', $this->text());
            $this->addColumn('article', 'call2action_description', $this->string(510));
            $this->addColumn('article', 'call2action_name', $this->string());
            $this->addColumn('article', 'call2action_link', $this->string());
            $this->addColumn('article', 'call2action_class', $this->string());
            $this->addColumn('article', 'call2action_comment', $this->text());
            $this->addColumn('article', 'object_type', $this->string());
            $this->addColumn('article', 'object_id', $this->integer());
            $this->addColumn('article', 'created_at', $this->integer());
            $this->addColumn('article', 'updated_at', $this->integer());
            $this->alterColumn('article', 'text', $this->text());

        }

    }

    public function safeDown()
    {
        $this->dropTable('article');

//        $this->dropColumn('article', 'type');
//        $this->dropColumn('article', 'topimage_title');
//        $this->dropColumn('article', 'background_image');
//        $this->dropColumn('article', 'background_image_title');
//        $this->dropColumn('article', 'thumbnail_image');
//        $this->dropColumn('article', 'thumbnail_image_alt');
//        $this->dropColumn('article', 'thumbnail_image_title');
//        $this->dropColumn('article', 'call2action_description');
//        $this->dropColumn('article', 'call2action_name');
//        $this->dropColumn('article', 'call2action_link');
//        $this->dropColumn('article', 'call2action_class');
//        $this->dropColumn('article', 'call2action_comment');
//        $this->dropColumn('article', 'object_type');
//        $this->dropColumn('article', 'object_id');
//        $this->dropColumn('article', 'created_at');
//        $this->dropColumn('article', 'updated_at');
//        $this->alterColumn('article', 'text', $this->text()->notNull());

    }


}
