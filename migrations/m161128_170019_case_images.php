<?php

use yii\db\Migration;

class m161128_170019_case_images extends Migration
{
    public function up()
    {
        $this->addColumn('{{%case}}', 'image', $this->string());
        $this->addColumn('{{%case}}', 'image2', $this->string());
    }

    public function down()
    {
        echo "m161128_170019_case_images cannot be reverted.\n";

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
