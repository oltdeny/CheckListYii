<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%item}}`.
 */
class m190318_142211_create_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%item}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'status' => $this->string()->defaultValue('todo'),
            'checklist_id' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk-item-checklist_id',
            'item',
            'checklist_id',
            'checklist',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%item}}');
    }
}
