<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%profile}}`.
 */
class m160928_034641_create_table_profile extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [

            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'full_name' => $this->string(255),
            'timezone' => $this->string(255),

        ]);
 
        // creates index for column `user_id`
        $this->createIndex(
            'profile_user_id',
            '{{%profile}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'profile_user_id',
            '{{%profile}}',
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
            'profile_user_id',
            '{{%profile}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'profile_user_id',
            '{{%profile}}'
        );

        $this->dropTable('{{%profile}}');
    }
}
