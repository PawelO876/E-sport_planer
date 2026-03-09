<?php

use yii\db\Migration;

class m260306_100000_add_auth_fields_to_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('users', 'auth_key', $this->string(255)->null());
        $this->addColumn('users', 'access_token', $this->string(255)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('users', 'auth_key');
        $this->dropColumn('users', 'access_token');
    }
}

