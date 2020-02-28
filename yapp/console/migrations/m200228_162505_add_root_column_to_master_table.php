<?php

use yii\db\Migration;

/**
 * Handles adding root to table `master`.
 */
class m200228_162505_add_root_column_to_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('master', 'root', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('master', 'root');
    }
}
