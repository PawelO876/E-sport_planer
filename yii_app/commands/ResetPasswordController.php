<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

/**
 * This command resets user passwords.
 *
 * To use this command, run: php yii reset-password/admin
 */
class ResetPasswordController extends Controller
{
    /**
     * Resets the admin user's password to 'admin'
     * @return int Exit code
     */
    public function actionAdmin()
    {
        $user = \app\models\User::findByUsername('admin');
        
        if ($user === null) {
            echo "Error: User 'admin' not found.\n";
            return ExitCode::UNSPECIFIED_ERROR;
        }
        
        $user->setPassword('admin');
        
        if ($user->save(false)) {
            echo "Success: Admin password has been reset to 'admin'.\n";
            return ExitCode::OK;
        } else {
            echo "Error: Failed to save the user.\n";
            return ExitCode::UNSPECIFIED_ERROR;
        }
    }
}

