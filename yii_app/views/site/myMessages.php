<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $messages */

$this->title = 'Moje wiadomości';
?>

<!-- My Messages Section -->
<section class="my-messages-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">Moje wiadomości</h1>
                
                <?php if (empty($messages)): ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        Nie masz jeszcze żadnych wiadomości. <?= Html::a('Wyślij wiadomość', ['site/contact']) ?>
                    </div>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Temat</th>
                                    <th>Treść</th>
                                    <th>Data</th>
                                    <th>Status</th>
                                    <th>Akcje</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($messages as $message): ?>
                                    <tr>
                                        <td><?= Html::encode($message->subject) ?></td>
                                        <td><?= Html::encode(mb_substr($message->body, 0, 50)) . (mb_strlen($message->body) > 50 ? '...' : '') ?></td>
                                        <td><?= Yii::$app->formatter->asDatetime($message->created_at) ?></td>
                                        <td>
                                            <?php if ($message->is_read): ?>
                                                <span class="badge bg-success">Przeczytane</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning text-dark">Nieprzeczytane</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <?= Html::a('<i class="fas fa-edit"></i>', ['site/update-message', 'id' => $message->id], [
                                                    'class' => 'btn btn-sm btn-outline-primary',
                                                    'title' => 'Edytuj',
                                                ]) ?>
                                                <?= Html::a('<i class="fas fa-trash"></i>', ['site/delete-message', 'id' => $message->id], [
                                                    'class' => 'btn btn-sm btn-outline-danger',
                                                    'title' => 'Usuń',
                                                    'data' => [
                                                        'confirm' => 'Czy na pewno chcesz usunąć tę wiadomość?',
                                                        'method' => 'post',
                                                    ],
                                                ]) ?>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
                
                <div class="mt-3">
                    <?= Html::a('<i class="fas fa-plus me-2"></i>Wyślij nową wiadomość', ['site/contact'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Powrót', ['site/index'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>
            </div>
        </div>
    </div>
</section>

