<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%apple}}`.
 */
class m200505_161125_create_apple_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apple}}', [
            'id' => $this->primaryKey(),
            'color' => $this->string(6)->notNull(),
            'date_create' => $this->timestamp()->defaultExpression('current_timestamp()'),
            'date_fall' => $this->timestamp()->defaultValue(null),
            'status' => $this->smallInteger(255)->defaultValue(0),
            'eat' => $this->smallInteger(100)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apple}}');
    }
}
