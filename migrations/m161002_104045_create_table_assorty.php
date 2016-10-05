<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%assorty}}`.
 */
class m161002_104045_create_table_assorty extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%assorty}}', [
            'id' => $this->primaryKey()->unsigned()->notNull(),
            'shop_id' => $this->integer(10)->unsigned()->notNull(),
            'item_id' => $this->integer(10)->unsigned()->notNull(),
        ]);
 
        // creates index for column `item_id`
        $this->createIndex(
            'assorty_fk1',
            '{{%assorty}}',
            'item_id'
        );

        // add foreign key for table `item`
        $this->addForeignKey(
            'assorty_fk1',
            '{{%assorty}}',
            'item_id',
            '{{%item}}',
            'id',
            'CASCADE'
        );

        // creates index for column `shop_id`
        $this->createIndex(
            'assorty_fk2',
            '{{%assorty}}',
            'shop_id'
        );

        // add foreign key for table `shop`
        $this->addForeignKey(
            'assorty_fk2',
            '{{%assorty}}',
            'shop_id',
            '{{%shop}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        // drops foreign key for table `item`
        $this->dropForeignKey(
            'assorty_fk1',
            '{{%assorty}}'
        );

        // drops index for column `item_id`
        $this->dropIndex(
            'assorty_fk1',
            '{{%assorty}}'
        );

        // drops foreign key for table `shop`
        $this->dropForeignKey(
            'assorty_fk2',
            '{{%assorty}}'
        );

        // drops index for column `shop_id`
        $this->dropIndex(
            'assorty_fk2',
            '{{%assorty}}'
        );

        $this->dropTable('{{%assorty}}');
    }
}
