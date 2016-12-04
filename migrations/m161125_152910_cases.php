<?php

use yii\db\Migration;

class m161125_152910_cases extends Migration
{
    public function up()
    {
        $this->createTable('{{%case}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'sum' => $this->money(),
            'min' => $this->money(),
            'max' => $this->money(),
            'real_max' => $this->money(),
            'risk' => $this->integer()->defaultValue(50),
            'active' => $this->boolean()->defaultValue(1),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    public function down()
    {
        echo "m161125_152910_cases cannot be reverted.\n";

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
