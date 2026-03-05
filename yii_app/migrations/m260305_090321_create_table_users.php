<?php

use yii\db\Migration;

class m260305_090321_create_table_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
 $this->createTable('users', [
        'id' => $this->primaryKey(),
        'username' => $this->string()->notNull(),
        'email' => $this->string()->notNull(),
        'password' => $this->string()->notNull(),
    ]);


    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260305_090321_create_table_users cannot be reverted.\n";

        return false;
    }
    */
}
