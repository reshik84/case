<?php

use yii\db\Migration;

class m161124_090835_user_role extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'role', $this->string(16)->defaultValue('user'));
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'role');

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
