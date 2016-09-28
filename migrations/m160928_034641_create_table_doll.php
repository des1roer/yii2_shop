<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%doll}}`.
 */
class m160928_034641_create_table_doll extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%doll}}', [

            'id' => $this->primaryKey()->unsigned()->notNull(),
            'user_id' => $this->integer(11)->notNull(),
            'item_id' => $this->integer(11)->unsigned()->notNull(),
            'part' => $this->string(128)->notNull(),

        ]);
 
        // creates index for column `user_id`
        $this->createIndex(
            'doll_fk1',
            '{{%doll}}',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'doll_fk1',
            '{{%doll}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `item_id`
        $this->createIndex(
            'doll_fk2',
            '{{%doll}}',
            'item_id'
        );

        // add foreign key for table `item`
        $this->addForeignKey(
            'doll_fk2',
            '{{%doll}}',
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
            'doll_fk1',
            '{{%doll}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'doll_fk1',
            '{{%doll}}'
        );

        // drops foreign key for table `item`
        $this->dropForeignKey(
            'doll_fk2',
            '{{%doll}}'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            'doll_fk2',
            '{{%doll}}'
        );

        $this->dropTable('{{%doll}}');
    }
}
