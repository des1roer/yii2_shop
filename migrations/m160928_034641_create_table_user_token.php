<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user_token}}`.
 */
class m160928_034641_create_table_user_token extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%user_token}}', [

            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11),
            'type' => $this->integer()->notNull(),
            'token' => $this->string(255)->notNull(),
            'data' => $this->string(255),
            'created_at' => $this->timestamp(),
            'expired_at' => $this->timestamp(),

        ]);
 
        // creates index for column `user_id`
        $this->createIndex(
            'user_token_user_id',
            '{{%user_token}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'user_token_user_id',
            '{{%user_token}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'user_token_user_id',
            '{{%user_token}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'user_token_user_id',
            '{{%user_token}}'
        );

        $this->dropTable('{{%user_token}}');
    }
}
