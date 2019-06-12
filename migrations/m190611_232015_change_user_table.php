<?php

use yii\db\Migration;

/**
 * Class m190611_232015_change_user_table
 */
class m190611_232015_change_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->renameColumn('{{%user}}', 'login', 'email');
        $this->addColumn('{{%user}}', 'email_confirm_token', $this->string()->unique()->after('email'));
        $this->addColumn('{{%user}}', 'status', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->renameColumn('{{%user}}', 'email', 'login');
        $this->dropColumn('{{%user}}', 'email_confirm_token');
        $this->dropColumn('{{%user}}', 'status');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190611_232015_change_user_table cannot be reverted.\n";

        return false;
    }
    */
}
