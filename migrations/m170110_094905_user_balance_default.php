<?php

use yii\db\Migration;

class m170110_094905_user_balance_default extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%user}}', 'balance', $this->money()->defaultValue(0));
    }

    public function down()
    {
        echo "m170110_094905_user_balance_default cannot be reverted.\n";

        return false;
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
