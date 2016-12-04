<?php

use yii\db\Migration;

class m161119_132641_add_balance_column extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'balance', $this->money());
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'balance');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
