<?php

use yii\db\Migration;

/**
 * Handles adding type to table `feedback`.
 */
class m200531_085449_add_type_column_to_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('feedback', 'type', $this->integer()->defaultValue(101));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('feedback', 'type');
    }
}
