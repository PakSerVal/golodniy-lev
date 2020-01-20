<?php

use yii\db\Migration;

/**
 * Создание таблицы отношения рецпта с тэгом.
 *
 * @author Pak Sergey
 */
class m200119_141146_create_receipt_tag_table extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->createTable('receipt_tag', [
            'receipt_id' => $this->integer(),
            'tag_id'     => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropTable('receipt_tag');
    }
}
