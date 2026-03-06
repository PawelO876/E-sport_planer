<?php

use Yii;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Training;
use app\models\Rest;

/** @var yii\web\View $this */

// Get stats data
$trainingCount = Training::find()->count();
$totalMinutes = Training::find()->sum('duration');
$restCount = Rest::find()->count();

$this->title = 'Statystyki';
?>

<div class="stats-index">
    <!-- Page Header -->
    <div class="page-header slide-up">
        <div>
            <h1><i class="fas fa-chart-line me-2" style="color: #f59e0b;"></i><?= Html::encode($this->title) ?></h1>
            <p class="text-muted mb-0">Przeglądaj swoje statystyki i postępy</p>
        </div>

    <!-- Stats Overview -->
    <div class="row g-4">
        <!-- Total Trainings -->
        <div class="col-md-6 col-lg-3">
            <div class="card slide-up" style="animation-delay: 0.1s;">
                <div class="card-body text-center">
                    <div class="icon-box mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-bullseye fa-2x text-white"></i>
                    </div>
                    <h2 class="mb-1" style="font-weight: 700; color: #10b981;"><?= $trainingCount ?></h2>
                    <p class="text-muted mb-0">Treningów</p>
                </div>
        </div>

        <!-- Total Time -->
        <div class="col-md-6 col-lg-3">
            <div class="card slide-up" style="animation-delay: 0.15s;">
                <div class="card-body text-center">
                    <div class="icon-box mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock fa-2x text-white"></i>
                    </div>
                    <h2 class="mb-1" style="font-weight: 700; color: #6366f1;"><?= $totalMinutes ?: 0 ?></h2>
                    <p class="text-muted mb-0">Minut treningu</p>
                </div>
        </div>

        <!-- Rest Entries -->
        <div class="col-md-6 col-lg-3">
            <div class="card slide-up" style="animation-delay: 0.2s;">
                <div class="card-body text-center">
                    <div class="icon-box mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-moon fa-2x text-white"></i>
                    </div>
                    <h2 class="mb-1" style="font-weight: 700; color: #8b5cf6;"><?= $restCount ?></h2>
                    <p class="text-muted mb-0">Wpisów odpoczynku</p>
                </div>
        </div>

        <!-- Efficiency Score -->
        <div class="col-md-6 col-lg-3">
            <div class="card slide-up" style="animation-delay: 0.25s;">
                <div class="card-body text-center">
                    <div class="icon-box mx-auto mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 15px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-trophy fa-2x text-white"></i>
                    </div>
                    <h2 class="mb-1" style="font-weight: 700; color: #f59e0b;"><?= $trainingCount > 0 ? round(($restCount / $trainingCount) * 100) : 0 ?>%</h2>
                    <p class="text-muted mb-0">Wskaźnik regeneracji</p>
                </div>
        </div>

    <!-- Progress Section -->
    <div class="row g-4 mt-2">
        <div class="col-lg-8">
            <div class="card slide-up" style="animation-delay: 0.3s;">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-2"></i>Postępy
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <div class="progress-ring mx-auto mb-3" style="width: 120px; height: 120px; position: relative;">
                                <svg width="120" height="120" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="rgba(99, 102, 241, 0.2)" stroke-width="10"/>
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#6366f1" stroke-width="10" 
                                        stroke-dasharray="<?= min($trainingCount * 10, 314) ?> 314" 
                                        stroke-linecap="round" 
                                        transform="rotate(-90 60 60)"/>
                                </svg>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    <strong style="font-size: 1.5rem;"><?= min($trainingCount * 10, 100) ?>%</strong>
                                </div>
                            <p class="text-muted">Cel: 10 treningów</p>
                        </div>
                        <div class="col-6">
                            <div class="progress-ring mx-auto mb-3" style="width: 120px; height: 120px; position: relative;">
                                <svg width="120" height="120" viewBox="0 0 120 120">
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="rgba(139, 92, 246, 0.2)" stroke-width="10"/>
                                    <circle cx="60" cy="60" r="50" fill="none" stroke="#8b5cf6" stroke-width="10" 
                                        stroke-dasharray="<?= min($restCount * 15, 314) ?> 314" 
                                        stroke-linecap="round" 
                                        transform="rotate(-90 60 60)"/>
                                </svg>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">
                                    <strong style="font-size: 1.5rem;"><?= min($restCount * 15, 100) ?>%</strong>
                                </div>
                            <p class="text-muted">Cel: 7 dni odpoczynku</p>
                        </div>
                </div>
        </div>

        <div class="col-lg-4">
            <div class="card slide-up" style="animation-delay: 0.35s;">
                <div class="card-header">
                    <i class="fas fa-star me-2"></i>Twoje osiągnięcia
                </div>
                <div class="card-body">
                    <?php if ($trainingCount >= 1): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-fire text-white"></i>
                            </div>
                            <div>
                                <strong>Pierwszy krok!</strong>
                                <p class="text-muted mb-0 small">Ukończono pierwszy trening</p>
                            </div>
                    <?php endif; ?>
                    
                    <?php if ($trainingCount >= 5): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-medal text-white"></i>
                            </div>
                            <div>
                                <strong>Na fali!</strong>
                                <p class="text-muted mb-0 small">5 ukończonych treningów</p>
                            </div>
                    <?php endif; ?>
                    
                    <?php if ($restCount >= 3): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                            <div>
                                <strong>Dbaj o siebie!</strong>
                                <p class="text-muted mb-0 small">3 wpisy odpoczynku</p>
                            </div>
                    <?php endif; ?>
                    
                    <?php if ($trainingCount < 1 && $restCount < 1): ?>
                        <div class="text-center py-4">
                            <i class="fas fa-trophy fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Zacznij trenować aby odblokować osiągnięcia!</p>
                        </div>
                    <?php endif; ?>
                </div>
        </div>

    <!-- Quick Actions -->
    <div class="card mt-4 slide-up" style="animation-delay: 0.4s;">
        <div class="card-header">
            <i class="fas fa-bolt me-2"></i>Szybkie działania
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <?= Html::a('<i class="fas fa-plus me-2"></i>Dodaj trening', ['/training/create'], ['class' => 'btn btn-success w-100']) ?>
                </div>
                <div class="col-md-4">
                    <?= Html::a('<i class="fas fa-moon me-2"></i>Dodaj odpoczynek', ['/rest/index'], ['class' => 'btn btn-primary w-100', 'style' => 'background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border: none;']) ?>
                </div>
                <div class="col-md-4">
                    <?= Html::a('<i class="fas fa-history me-2"></i>Historia treningów', ['/training/index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
        </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Wróć do strony głównej', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

<style>
.progress-ring circle {
    transition: stroke-dasharray 0.5s ease;
}
</style>
