<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%context_ad}}`.
 */
class m201228_163741_create_context_ad_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%context_ad}}', [
            'id' => $this->primaryKey(),
            'host' => $this->integer()->notNull(),
            'master_id' => $this->integer()->unsigned()->notNull(),
            'id_on_host' => $this->string()->notNull(),
            'type'=>$this->string(),
            'name'=>$this->string(),

            'daily_limit'=>$this->integer(),

            'status' => $this->integer(),

            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%context_ad}}');
    }
}
