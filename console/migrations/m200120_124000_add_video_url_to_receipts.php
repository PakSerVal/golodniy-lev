<?php

use yii\db\Migration;

/**
 * Добавление видео рецепта.
 *
 * @author Pak Sergey
 */
class m200120_124000_add_video_url_to_receipts extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->addColumn('receipt', 'video_url', 'TEXT');
        $this->addCommentOnColumn('receipt', 'video_url', 'Видео рецепта');
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropColumn('receipt', 'video_url');
    }
}
