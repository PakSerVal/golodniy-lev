<?php

use yii\db\Migration;

/**
 * Создание таблицы отношения ингридиента к рецепту.
 *
 * @author Pak Sergey
 */
class m200116_044746_create_receipt_ingredient_table extends Migration {

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeUp() {
        $this->createTable('receipt_ingredient', [
            'id'            => $this->primaryKey(),
            'receipt_id'    => $this->integer()->notNull()->comment('Идентификатор рецепта'),
            'ingredient_id' => $this->integer()->notNull()->comment('Идентификатор ингредиента'),
            'count'         => $this->string(64)->notNull()->comment('Количество ингредиентов'),
            'measure_unit'  => $this->string(16)->notNull()->comment('Единица измерения'),
        ]);
    }

    /**
     * {@inheritdoc}
     *
     * @author Pak Sergey
     */
    public function safeDown() {
        $this->dropTable('receipt_ingredient');
    }
}
