<?php

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \app\models\Training[] $trainingList */

$this->title = 'Treningi';
?>

<div class="training-index">
    <!-- Page Header -->
    <div class="page-header slide-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1><i class="fas fa-bullseye me-2" style="color: #10b981;"></i><?= Html::encode($this->title) ?></h1>
                <p class="text-muted mb-0">Zarządzaj swoimi treningami i śledź postępy</p>
            </div>
            <?= Html::a('<i class="fas fa-plus me-2"></i>Dodaj trening', ['create'], ['class' => 'btn btn-success']) ?>
        </div>

    <!-- Alert Messages -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success fade-in">
            <i class="fas fa-check-circle me-2"></i><?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <!-- Training List -->
    <?php if (!empty($trainingList)): ?>
        <div class="card slide-up" style="animation-delay: 0.1s;">
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
        
        <!-- Stats Summary -->
        <div class="row g-3 mt-4">
            <div class="col-md-4">
                <div class="card stat-card" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
                    <div class="card-body text-center text-white">
                        <i class="fas fa-clipboard-list fa-2x mb-2"></i>
                        <h3><?= count($trainingList) ?></h3>
                        <p class="mb-0">Łącznie treningów</p>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card" style="background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);">
                    <div class="card-body text-center text-white">
                        <i class="fas fa-clock fa-2x mb-2"></i>
                        <h3><?= array_sum(array_column($trainingList, 'duration')) ?></h3>
                        <p class="mb-0">Minut łącznie</p>
                    </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);">
                    <div class="card-body text-center text-white">
                        <i class="fas fa-gamepad fa-2x mb-2"></i>
                        <h3><?= count(array_unique(array_column($trainingList, 'game'))) ?></h3>
                        <p class="mb-0">Gier</p>
                    </div>
            </div>
    <?php else: ?>
        <div class="card slide-up">
            <div class="card-body text-center py-5">
                <i class="fas fa-gamepad fa-4x text-muted mb-3"></i>
                <h4 class="text-muted">Brak zapisanych treningów</h4>
                <p class="text-muted">Rozpocznij swoją przygodę z e-sportem!</p>
                <?= Html::a('<i class="fas fa-plus me-2"></i>Dodaj pierwszy trening', ['create'], ['class' => 'btn btn-primary']) ?>
            </div>
    <?php endif; ?>
    
    <!-- Back Button -->
    <div class="mt-4">
        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Wróć do strony głównej', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
