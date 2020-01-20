<?php

use yii\db\Migration;

/**
 * Creating receipt step table.
 *
 * @author Pak Sergey
 */
class m200101_151544_create_steps_table extends Migration {
    private $tableName = 'receipt_step';

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->createTable($this->tableName, [
            'id'         => $this->primaryKey(),
            'content'    => $this->text()->notNull()->comment('Контент шага'),
            'receipt_id' => $this->integer()->notNull()->comment('Идентификатор рецепта'),
            'image_id'   => $this->integer()->null()->comment('Идентификатор изображения'),
            'number'     => $this->integer()->defaultValue(1)->comment('Идентификатор изображения'),
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropTable($this->tableName);
    }
}
