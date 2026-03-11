<?php

namespace app\migrations;

use yii\db\Migration;

class m260307_000001_add_role_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'role', $this->string(20)->defaultValue('user'));
        
        // Set existing 'admin' user as admin
        $this->update('users', ['role' => 'admin'], ['username' => 'admin']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'role');
    }
}

