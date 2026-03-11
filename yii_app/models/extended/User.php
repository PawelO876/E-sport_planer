<?php

namespace app\models\extended;

class User extends \app\models\generated\User
{
    /**
     * Roles constants
     */
    const ROLE_USER = 'user';
    const ROLE_ADMIN = 'admin';

    /**
     * Check if user is admin
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }
}
