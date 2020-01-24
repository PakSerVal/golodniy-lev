<?php

use yii\db\Migration;

/**
 * Создание индекса для заголовка тэга.
 *
 * @author Pak Sergey
 */
class m200124_152836_create_tag_title_index extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->createIndex('ix-tag-title', 'tag', 'title');
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropIndex('ix-tag-title', 'tag');
    }
}
