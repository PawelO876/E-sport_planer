<?php

namespace app\migrations;

use yii\db\Migration;

/**
 * Class m260307_000003_add_user_id_to_messages
 */
class m260307_000003_add_user_id_to_messages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Add user_id column to messages table (nullable for backward compatibility)
        $this->addColumn('messages', 'user_id', $this->integer()->null()->after('id'));
        
        // Add foreign key
        $this->addForeignKey(
            'fk_messages_user_id',
            'messages',
            'user_id',
            'users',
            'id',
            'SET NULL',
            'CASCADE'
        );
        
        // Add index
        $this->createIndex(
            'idx_messages_user_id',
            'messages',
            'user_id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_messages_user_id', 'messages');
        $this->dropIndex('idx_messages_user_id', 'messages');
        $this->dropColumn('messages', 'user_id');
    }
}

