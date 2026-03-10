<?php

namespace app\migrations;

use yii\db\Migration;

class m260305_090358_create_table_trainings extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

$this->createTable('trainings', [
        'id' => $this->primaryKey(),
        'user_id' => $this->integer()->notNull(),
        'game' => $this->string()->notNull(),
        'training_type' => $this->string()->notNull(),
        'duration' => $this->integer()->comment('czas treningu w godzinach'),
        'date' => $this->date()
    ]);

    $this->addForeignKey(
        'fk-trainings-user_id',
        'trainings',
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
        $this->dropTable('trainings');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260305_090358_create_table_trainings cannot be reverted.\n";

        return false;
    }
    */
}
