<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ingredient}}`.
 */
class m200115_132307_create_ingredient_table extends Migration {

    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $this->createTable('ingredient', [
            'id'    => $this->primaryKey(),
            'title' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('ingredient');
    }
}
