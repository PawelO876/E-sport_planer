<?php

namespace app\migrations;

use yii\db\Migration;

class m260305_090407_create_table_rest extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    $this->createTable('rest', [
        'id' => $this->primaryKey(),
        'user_id' => $this->integer()->notNull(),
        'rest_type' => $this->string(),
        'date' => $this->date()
    ]);

    $this->addForeignKey(
        'fk-rest-user_id',
        'rest',
        'user_id',
        'users',
        'id',
        'CASCADE'
    );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('rest');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260305_090407_create_table_rest cannot be reverted.\n";

        return false;
    }
    */
}
