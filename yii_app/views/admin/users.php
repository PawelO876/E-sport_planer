<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\extended\User;

/* @var $this yii\web\View */
/* @var $users User[] */

$this->title = 'Użytkownicy';
?>

<div class="admin-users">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (empty($users)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Brak użytkowników.
        </div>
    <?php else: ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Użytkownik</th>
                    <th>Email</th>
                    <th>Rola</th>
                    <th>Utworzono</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td>
                            <?= Html::encode($user->username) ?>
                            <?php if ($user->id == Yii::$app->user->id): ?>
                                <span class="badge bg-primary">Ty</span>
                            <?php endif; ?>
                        </td>
                        <td><?= Html::encode($user->email) ?></td>
                        <td>
                            <?php if ($user->isAdmin()): ?>
                                <span class="badge bg-danger">Administrator</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Użytkownik</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $user->auth_key ? date('Y-m-d') : '-' ?></td>
                        <td>
                            <?php if ($user->id != Yii::$app->user->id && !$user->isAdmin()): ?>
                                <?= Html::a('<i class="fas fa-trash"></i> Usuń', 
                                    Url::to(['delete-user', 'id' => $user->id]), 
                                    [
                                        'class' => 'btn btn-sm btn-danger',
                                        'title' => 'Usuń użytkownika',
                                        'data' => [
                                            'confirm' => 'Czy na pewno chcesz usunąć użytkownika ' . Html::encode($user->username) . '?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ) ?>
                            <?php elseif ($user->isAdmin()): ?>
                                <span>Nie można usunąć administratora</span>
                            <?php else: ?>
                                <span>Nie można usunąć swojego konta</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    
    <div class="mt-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Wróć do panelu admina', ['/admin/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>

