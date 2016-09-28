<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%inventory}}`.
 */
class m160928_034641_create_table_inventory extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%inventory}}', [

            'id' => $this->primaryKey()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'item_id' => $this->integer(10)->unsigned()->notNull(),

        ]);
 
        // creates index for column `user_id`
        $this->createIndex(
            'inventory_fk1',
            '{{%inventory}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'inventory_fk1',
            '{{%inventory}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `item_id`
        $this->createIndex(
            'inventory_fk2',
            '{{%inventory}}',
            'item_id'
        );

        // add foreign key for table `item`
        $this->addForeignKey(
            'inventory_fk2',
            '{{%inventory}}',
            'item_id',
            '{{%item}}',
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
            'inventory_fk1',
            '{{%inventory}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'inventory_fk1',
            '{{%inventory}}'
        );

        // drops foreign key for table `item`
        $this->dropForeignKey(
            'inventory_fk2',
            '{{%inventory}}'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            'inventory_fk2',
            '{{%inventory}}'
        );

        $this->dropTable('{{%inventory}}');
    }
}
