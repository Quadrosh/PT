<?php

use yii\db\Migration;

/**
 * Handles the creation of table `master_service`.
 */
class m200921_154844_create_master_service_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('master_service', [
            'id' => $this->primaryKey(),
            'master_id' => $this->integer(),
            'name' => $this->string(),
            'value' => $this->string(),
            'comment' => $this->string(),
            'sort' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('master_service');
    }
}
