<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%image}}`.
 */
class m191020_122044_create_image_table extends Migration {
    private $tableName = 'image';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable($this->tableName, [
            'id'   => $this->primaryKey(),
            'name' => $this->text()->null(),
            'path' => $this->text()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable($this->tableName);
    }
}
