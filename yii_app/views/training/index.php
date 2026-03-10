<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \app\models\extended\Training[] $trainingList */

$this->title = 'Treningi';
?>

<div class="training-index">
    <!-- Page Header -->
    <div class="page-header slide-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1><i class="fas fa-bullseye me-2 icon-green"></i><?= Html::encode($this->title) ?></h1>
                <p class="text-muted mb-0">Zarządzaj swoimi treningami i śledź postępy</p>
            </div>
            <?= Html::a('<i class="fas fa-plus me-2"></i>Dodaj trening', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success fade-in">
            <i class="fas fa-check-circle me-2"></i><?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <!-- Training Stats with Progress Bars -->
    <div class="row g-4 mb-4">
        <!-- Training Progress -->
        <div class="col-md-6">
            <div class="card slide-up animation-delay-2">
                <div class="card-header">
                    <i class="fas fa-bullseye me-2"></i>Postępy w treningach
                </div>
                <div class="card-body">
                    <?php 
                    $trainingCount = !empty($trainingList) ? count($trainingList) : 0;
                    $totalMinutes = !empty($trainingList) ? array_sum(array_column($trainingList, 'duration')) : 0;
                    $uniqueGames = !empty($trainingList) ? count(array_unique(array_column($trainingList, 'game'))) : 0;
                    ?>
                    
                    <!-- Progress bar for training goal -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-trophy me-2 text-warning"></i><strong>Cel: 10 treningów</strong></span>
                            <span class="badge bg-success"><?= $trainingCount ?>/10</span>
                        </div>
                        <div class="progress" style="height: 24px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= min($trainingCount * 10, 100) ?>%;" aria-valuenow="<?= $trainingCount ?>" aria-valuemin="0" aria-valuemax="10">
                                <?= min($trainingCount * 10, 100) ?>%
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats boxes -->
                    <div class="row text-center mt-4">
                        <div class="col-4">
                            <div class="stat-box p-3 rounded">
                                <i class="fas fa-bullseye fa-2x text-success mb-2"></i>
                                <h4 class="mb-0"><?= $trainingCount ?></h4>
                                <small class="text-muted">Treningów</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-box p-3 rounded">
                                <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                <h4 class="mb-0"><?= $totalMinutes ?></h4>
                                <small class="text-muted">Minut</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-box p-3 rounded">
                                <i class="fas fa-gamepad fa-2x text-purple mb-2"></i>
                                <h4 class="mb-0"><?= $uniqueGames ?></h4>
                                <small class="text-muted">Gier</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Training Types -->
        <div class="col-md-6">
            <div class="card slide-up animation-delay-3">
                <div class="card-header">
                    <i class="fas fa-tags me-2"></i>Rodzaje treningów
                </div>
                <div class="card-body">
                    <?php 
                    if (!empty($trainingList)) {
                        $trainingTypes = array_count_values(array_column($trainingList, 'training_type'));
                        arsort($trainingTypes);
                    } else {
                        $trainingTypes = [];
                    }
                    
                    if (!empty($trainingTypes)): 
                    ?>
                        <?php foreach (array_slice($trainingTypes, 0, 5) as $type => $count): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span><i class="fas fa-crosshairs me-2 text-success"></i><?= Html::encode($type) ?></span>
                                <span class="badge bg-success"><?= $count ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted text-center">Brak danych o typach treningów</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Training List -->
    <?php if (!empty($trainingList)): ?>
        <div class="card slide-up animation-delay-1">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="fas fa-list me-2"></i>Historia treningów</span>
                <span class="badge bg-primary"><?= count($trainingList) ?> treningów</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th><i class="fas fa-calendar me-2"></i>Data</th>
                                <th><i class="fas fa-clock me-2"></i>Czas (min)</th>
                                <th><i class="fas fa-gamepad me-2"></i>Gra</th>
                                <th><i class="fas fa-tags me-2"></i>Typ treningu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($trainingList as $training): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-25 text-primary">
                                            <i class="fas fa-calendar-day me-1"></i>
                                            <?= Html::encode($training->date) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success bg-opacity-25 text-success">
                                            <i class="fas fa-hourglass-half me-1"></i>
                                            <?= Html::encode($training->duration) ?> min
                                        </span>
                                    </td>
                                    <td>
                                        <strong><?= Html::encode($training->game) ?></strong>
                                    </td>
                                    <td>
                                        <span class="badge bg-info bg-opacity-25 text-info">
                                            <?= Html::encode($training->training_type) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="card slide-up">
            <div class="card-body text-center py-5">
                <i class="fas fa-gamepad fa-4x mb-3"></i>
                <h4>Brak zapisanych treningów</h4>
                <p>Rozpocznij swoją przygodę z e-sportem!</p>
                <?= Html::a('<i class="fas fa-plus me-2"></i>Dodaj pierwszy trening', ['create'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    <?php endif; ?>
    
    <!-- Back Button -->
    <div class="mt-4">
        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Wróć do strony głównej', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>

