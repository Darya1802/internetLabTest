<?php

use yii\db\Migration;

class m240711_164112_create_user_table extends Migration
{
    public function safeUp(): void
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
             'email' => $this->string()->null(),
            'password' => $this->string()->notNull(),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable('user');
    }
}
