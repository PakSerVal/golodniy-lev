<?php

use yii\db\Migration;

/**
 * Create receipt table.
 */
class m191020_115511_create_receipt_table extends Migration {
    private $tableName = 'receipt';

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable($this->tableName, [
            'id'            => $this->primaryKey(),
            'title'         => $this->text()->notNull()->comment('Заголовок рецепта'),
            'main_image_id' => $this->integer()->notNull()->comment('Идентификатор основного изображения'),
            'created_at'    => $this->timestamp()->notNull()->defaultExpression("TIMEZONE('UTC', now())")
        ]);

        $this->createIndex('ix_' . $this->tableName . '[title]', $this->tableName, 'title');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable($this->tableName);
    }
}
