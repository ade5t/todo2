<?php

use yii\db\Migration;

/**
 * Class m190616_214113_change_todo_table
 */
class m190616_214113_change_todo_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%todo}}', 'is_Send', $this->boolean());
        $this->addColumn('{{%todo}}', 'date_time', $this->dateTime());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->DropColumn('{{%todo}}', 'is_Send');
        $this->DropColumn('{{%todo}}', 'date_time');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190616_214113_change_todo_table cannot be reverted.\n";

        return false;
    }
    */
}
