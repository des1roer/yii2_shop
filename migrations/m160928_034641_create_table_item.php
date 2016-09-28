<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%item}}`.
 */
class m160928_034641_create_table_item extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [

            'id' => $this->primaryKey()->unsigned()->notNull(),
            'name' => $this->string(20)->notNull(),
            'img' => $this->string(20),
            'cost' => $this->integer(10)->unsigned()->notNull(),

        ]);
     }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
