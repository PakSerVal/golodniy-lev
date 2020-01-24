<?php

use common\models\Media;
use yii\db\Migration;

/**
 * Сохдание таблицы для хранения информации о меди данных.
 *
 * @author Pak Sergey
 */
class m200124_150012_create_media_table extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->createTable('media', [
            'id'      => $this->primaryKey(),
            'name'    => $this->string()->notNull(),
            'count'   => $this->integer()->notNull(),
        ]);

        $this->insert('media', ['id' => Media::MEDIA_YOUTUBE_ID, 'name' => 'youtube', 'count' => 60000]);
        $this->insert('media', ['id' => Media::MEDIA_INSTAGRAM_ID, 'name' => 'instagram', 'count' => 1000]);
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropTable('media');
    }
}
