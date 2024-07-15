<?php

use yii\db\Migration;

class m240711_164112_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
            'name' => $this->string()->null(),
            'email' => $this->string()->null()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('user');
    }
}
