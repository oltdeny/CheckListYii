<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%checklist}}`.
 */
class m190315_133427_create_checklist_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%checklist}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'user_id' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-checklist-user_id',
            'checklist',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%checklist}}');
    }
}
