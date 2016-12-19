<?php

use yii\db\Migration;

class m161208_180227_operation_cashout_fields extends Migration
{
    public function up()
    {
        $this->addColumn('{{%operation}}', 'psys', $this->integer());
        $this->addColumn('{{%operation}}', 'wallet', $this->string());
    }

    public function down()
    {
        $this->dropColumn('{{%operation}}', 'psys');
        $this->dropColumn('{{%operation}}', 'wallet');
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
