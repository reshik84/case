<?php

use yii\db\Migration;

class m161125_155749_operations extends Migration
{
    public function up()
    {
        $this->createTable('{{%operation}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'type' => $this->string(16), // CASHIN, CASHOUT, OPEN, PRIZE, REF
            'sum' => $this->money(),
            'batch' => $this->string(255),
            'created_at' => $this->integer(),
            'confirmed_at' => $this->integer(),
            'status' => $this->integer(),
            'memo' => $this->string(),
            'case_id' => $this->integer()->null(),
            'ref_id' => $this->integer()->null(),
        ]);
    }

    public function down()
    {
        echo "m161125_155749_operations cannot be reverted.\n";

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
