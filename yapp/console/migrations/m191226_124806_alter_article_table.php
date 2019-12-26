<?php

use yii\db\Migration;

class m191226_124806_alter_article_table extends Migration
{
    public function safeUp()
    {
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

    public function safeDown()
    {
        $this->dropColumn('article', 'type');
        $this->dropColumn('article', 'topimage_title');
        $this->dropColumn('article', 'background_image');
        $this->dropColumn('article', 'background_image_title');
        $this->dropColumn('article', 'thumbnail_image');
        $this->dropColumn('article', 'thumbnail_image_alt');
        $this->dropColumn('article', 'thumbnail_image_title');
        $this->dropColumn('article', 'call2action_description');
        $this->dropColumn('article', 'call2action_name');
        $this->dropColumn('article', 'call2action_link');
        $this->dropColumn('article', 'call2action_class');
        $this->dropColumn('article', 'call2action_comment');
        $this->dropColumn('article', 'object_type');
        $this->dropColumn('article', 'object_id');
        $this->dropColumn('article', 'created_at');
        $this->dropColumn('article', 'updated_at');
        $this->alterColumn('article', 'text', $this->text()->notNull());

    }


}
