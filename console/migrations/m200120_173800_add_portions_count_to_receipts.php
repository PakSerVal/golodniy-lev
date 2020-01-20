<?php

use yii\db\Migration;

/**
 * Добавление количества порций к рецепту рецепта.
 *
 * @author Pak Sergey
 */
class m200120_173800_add_portions_count_to_receipts extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->addColumn('receipt', 'portions_count', 'INTEGER');
        $this->addCommentOnColumn('receipt', 'portions_count', 'Количество порций');
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropColumn('receipt', 'portions_count');
    }
}
