<?php

use yii\db\Migration;

/**
 * Handles the creation for table `{{%item}}`.
 */
class m161002_104045_create_table_item extends Migration
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
            'type' => $this->integer(11)->unsigned()->notNull()->defaultValue(1),

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
