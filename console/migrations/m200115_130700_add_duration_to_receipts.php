<?php

use yii\db\Migration;

/**
 * Добавление времени приготовления рецепта.
 *
 * @author Pak Sergey
 */
class m200115_130700_add_duration_to_receipts extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->addColumn('receipt', 'duration', 'INT DEFAULT 0');
        $this->addCommentOnColumn('receipt', 'duration', 'Время приготовления рецепта в минутах');
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropColumn('receipt', 'duration');
    }
}
