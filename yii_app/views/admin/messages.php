<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\extended\Message;

/* @var $this yii\web\View */
/* @var $messages Message[] */

$this->title = 'Wiadomości';
?>

<div class="admin-messages">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if (empty($messages)): ?>
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i> Brak wiadomości.
        </div>
    <?php else: ?>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Imię</th>
                    <th>Email</th>
                    <th>Temat</th>
                    <th>Treść</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr class="<?= $message->is_read ? '' : 'table-warning' ?>">
                        <td><?= $message->id ?></td>
                        <td><?= Html::encode($message->name) ?></td>
                        <td><?= Html::encode($message->email) ?></td>
                        <td><?= Html::encode($message->subject) ?></td>
                        <td>
                            <?= Html::encode(mb_substr($message->body, 0, 50)) ?>
                            <?= mb_strlen($message->body) > 50 ? '...' : '' ?>
                        </td>
                        <td><?= date('Y-m-d H:i', $message->created_at) ?></td>
                        <td>
                            <?php if ($message->is_read): ?>
                                <span class="badge bg-success">Przeczytana</span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Nieprzeczytana</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <?= Html::a('<i class="fas fa-eye"></i>', '#', [
                                    'class' => 'btn btn-sm btn-info',
                                    'data-bs-toggle' => 'modal',
                                    'data-bs-target' => '#messageModal' . $message->id,
                                    'title' => 'Zobacz',
                                ]) ?>
                                
                                <?php if (!$message->is_read): ?>
                                    <?= Html::a('<i class="fas fa-check"></i>', 
                                        Url::to(['mark-message-read', 'id' => $message->id]), 
                                        ['class' => 'btn btn-sm btn-secondary', 'title' => 'Oznacz jako przeczytana']
                                    ) ?>
                                <?php endif; ?>
                                
                                <?= Html::a('<i class="fas fa-trash"></i>', 
                                    Url::to(['delete-message', 'id' => $message->id]), 
                                    [
                                        'class' => 'btn btn-sm btn-danger',
                                        'title' => 'Usuń',
                                        'data' => [
                                            'confirm' => 'Czy na pewno chcesz usunąć tę wiadomość?',
                                            'method' => 'post',
                                        ],
                                    ]
                                ) ?>
                            </div>
                            
                            <!-- Modal for message details -->
                            <div class="modal fade" id="messageModal<?= $message->id ?>" tabindex="-1" aria-labelledby="messageModalLabel<?= $message->id ?>" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="messageModalLabel<?= $message->id ?>">
                                                <?= Html::encode($message->subject) ?>
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Od:</strong> <?= Html::encode($message->name) ?> (<?= Html::encode($message->email) ?>)</p>
                                            <p><strong>Data:</strong> <?= date('Y-m-d H:i', $message->created_at) ?></p>
                                            <hr>
                                            <p><?= nl2br(Html::encode($message->body)) ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zamknij</button>
                                            <?php if (!$message->is_read): ?>
                                                <?= Html::a('Oznacz jako przeczytana', 
                                                    Url::to(['mark-message-read', 'id' => $message->id]), 
                                                    ['class' => 'btn btn-primary']
                                                ) ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

