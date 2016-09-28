<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%role}}`.
 */
class m160928_034641_create_table_role extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%role}}', [

            'id' => $this->primaryKey()->notNull(),
            'name' => $this->string(255)->notNull(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
            'can_admin' => $this->integer()->notNull(),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%role}}');
    }
}
