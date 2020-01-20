<?php

use yii\db\Migration;

/**
 * Добавление описания рецепта.
 *
 * @author Pak Sergey
 */
class m200117_182400_add_description_to_receipts extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->addColumn('receipt', 'description', 'TEXT');
        $this->addCommentOnColumn('receipt', 'description', 'Описание рецепта');
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropColumn('receipt', 'description');
    }
}
