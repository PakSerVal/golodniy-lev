<?php

use yii\db\Migration;

/**
 * Изменение размера колонки заголовка тэга.
 *
 * @author Pak Sergey
 */
class m200123_135658_alter_tag_title_column extends Migration
{
    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->alterColumn('tag', 'title', 'text');
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->alterColumn('tag', 'title', 'varchar(32)');
    }
}
