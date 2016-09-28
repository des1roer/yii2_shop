<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%shop}}`.
 */
class m160928_034641_create_table_shop extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%shop}}', [

            'id' => $this->primaryKey()->unsigned()->notNull(),
            'name' => $this->string(20)->notNull(),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%shop}}');
    }
}
