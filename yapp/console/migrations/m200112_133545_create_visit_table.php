<?php

use yii\db\Migration;

/**
 * Handles the creation of table `visit`.
 */
class m200112_133545_create_visit_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('visit', [
            'id' => $this->primaryKey(),
            'site' => $this->string(),
            'lp_hrurl' => $this->string(),
            'ip' => $this->string(),
            'city' => $this->string(),
            'url' => $this->string(),
            'utm_source' => $this->string(510),
            'utm_medium' => $this->string(510),
            'utm_campaign' => $this->string(510),
            'utm_content' => $this->string(510),
            'utm_term' => $this->string(510),
            'qnt' => $this->integer(),
            'comment' => $this->string(),
            'created_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('visit');
    }
}
