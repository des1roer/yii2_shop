<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user}}`.
 */
class m160928_034641_create_table_user extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [

            'id' => $this->primaryKey()->notNull(),
            'role_id' => $this->integer(11)->notNull(),
            'status' => $this->integer()->notNull(),
            'email' => $this->string(255),
            'username' => $this->string(255),
            'password' => $this->string(255),
            'auth_key' => $this->string(255),
            'access_token' => $this->string(255),
            'logged_in_ip' => $this->string(255),
            'logged_in_at' => $this->timestamp(),
            'created_ip' => $this->string(255),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'banned_at' => $this->timestamp(),
            'banned_reason' => $this->string(255),
            'name' => $this->string(255),
            'money' => $this->integer(10)->unsigned(),

        ]);
 
        // creates index for column `role_id`
        $this->createIndex(
            'user_role_id',
            '{{%user}}',
            'role_id'
        );

        // add foreign key for table `role`
        $this->addForeignKey(
            'user_role_id',
            '{{%user}}',
            'role_id',
            '{{%role}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `role`
        $this->dropForeignKey(
            'user_role_id',
            '{{%user}}'
        );

        // drops index for column `role_id`
        $this->dropIndex(
            'user_role_id',
            '{{%user}}'
        );

        $this->dropTable('{{%user}}');
    }
}
