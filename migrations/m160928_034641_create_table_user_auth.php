<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%user_auth}}`.
 */
class m160928_034641_create_table_user_auth extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%user_auth}}', [

            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'provider' => $this->string(255)->notNull(),
            'provider_id' => $this->string(255)->notNull(),
            'provider_attributes' => $this->text()->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),

        ]);
 
        // creates index for column `user_id`
        $this->createIndex(
            'user_auth_user_id',
            '{{%user_auth}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'user_auth_user_id',
            '{{%user_auth}}',
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
            'user_auth_user_id',
            '{{%user_auth}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'user_auth_user_id',
            '{{%user_auth}}'
        );

        $this->dropTable('{{%user_auth}}');
    }
}
