<?php

use yii\db\Migration;

/**
 * Handles adding custom_class to table `article`.
 */
class m200530_081300_add_custom_class_column_to_article_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('article', 'custom_class', $this->string());
        $this->addColumn('article', 'pagehead_class', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('article', 'custom_class');
        $this->dropColumn('article', 'pagehead_class');
    }
}
