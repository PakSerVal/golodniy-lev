<?php

use yii\db\Migration;

/**
 * Создание таблицы тэгов.
 *
 * @author Pak Sergey
 */
class m200119_140627_create_tag_table extends Migration {
    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->createTable('tag', [
            'id'    => $this->primaryKey(),
            'title' => $this->string(32)->unique(),
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropTable('tag');
    }
}
