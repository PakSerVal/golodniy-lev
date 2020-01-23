<?php

use yii\db\Migration;

/**
 * Создание таблицы количества просмотров рецептов.
 *
 * @author Pak Sergey
 */
class m200123_115547_create_receipt_views_count_table extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->createTable('receipt_views_count', [
            'id'         => $this->primaryKey(),
            'receipt_id' => $this->integer()->notNull(),
            'count'      => $this->integer()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropTable('receipt_views_count');
    }
}
