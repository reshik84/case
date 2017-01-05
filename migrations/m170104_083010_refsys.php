<?php

use yii\db\Migration;

class m170104_083010_refsys extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'sponsor_id', $this->integer()->null());
        $this->insert('settings', [
            'type' => 'integer',
            'section' => 'case',
            'key' => 'found',
            'value' => 0
        ]);
        $this->insert('settings', [
            'type' => 'integer',
            'section' => 'case',
            'key' => 'perfect',
            'value' => 0
        ]);
        $this->insert('settings', [
            'type' => 'string',
            'section' => 'case',
            'key' => 'refsys',
            'value' => '7;5;3;1'
        ]);
    }

    public function down()
    {
        echo "m170104_083010_refsys cannot be reverted.\n";

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
