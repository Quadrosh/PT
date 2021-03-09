<?php

use yii\db\Migration;

/**
 * Class m201228_162453_add_balance_to_master_table
 */
class m201228_162453_add_balance_to_master_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%master}}', 'account_balance', $this->integer());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%master}}', 'account_balance');

    }


}
