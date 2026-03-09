<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Training;
use app\models\Rest;

/** @var yii\web\View $this */

/* @var int $trainingCount */
/* @var int|null $totalMinutes */
/* @var int $restCount */

$this->title = 'Statystyki';
?>

<div class="stats-index">
    <!-- Page Header -->
    <div class="page-header slide-up">
        <div>
            <h1><i class="fas fa-chart-line me-2 icon-amber"></i><?= Html::encode($this->title) ?></h1>
            <p class="mb-0">Przeglądaj swoje statystyki i postępy</p>
        </div>

    <!-- Main Stat Card -->
    <div class="card slide-up mb-4" style="background: linear-gradient(135deg, #1e3a5f 0%, #0f172a 100%);">
        <div class="card-body text-center py-5">
            <div class="stat-value" id="mainStatValue" style="font-size: 4rem; font-weight: 700; color: #10b981;">
                <?= $trainingCount ?>
            </div>
            <p class="mb-3" id="mainStatLabel" style="font-size: 1.25rem; color: #e2e8f0;">Treningów</p>
            
            <!-- Stat Toggles -->
            <div class="d-flex justify-content-center gap-2 flex-wrap">
                <button class="btn btn-sm stat-btn active" data-value="<?= $trainingCount ?>" data-label="Treningów" data-color="#10b981" onclick="changeStat(this, <?= $trainingCount ?>, 'Treningów', '#10b981')">
                    <i class="fas fa-bullseye me-1"></i> Treningi
                </button>
                <button class="btn btn-sm stat-btn" data-value="<?= $totalMinutes ?: 0 ?>" data-label="Minut treningu" data-color="#6366f1" onclick="changeStat(this, <?= $totalMinutes ?: 0 ?>, 'Minut treningu', '#6366f1')">
                    <i class="fas fa-clock me-1"></i> Czas
                </button>
                <button class="btn btn-sm stat-btn" data-value="<?= $restCount ?>" data-label="Wpisów odpoczynku" data-color="#8b5cf6" onclick="changeStat(this, <?= $restCount ?>, 'Wpisów odpoczynku', '#8b5cf6')">
                    <i class="fas fa-moon me-1"></i> Odpoczynek
                </button>
                <button class="btn btn-sm stat-btn" data-value="<?= $trainingCount > 0 ? round(($restCount / $trainingCount) * 100) : 0 ?>" data-label="Wskaźnik regeneracji" data-color="#f59e0b" onclick="changeStat(this, <?= $trainingCount > 0 ? round(($restCount / $trainingCount) * 100) : 0 ?>, 'Wskaźnik regeneracji', '#f59e0b')">
                    <i class="fas fa-trophy me-1"></i> Regeneracja
                </button>
            </div>
        </div>
    </div>

    <!-- Progress Section -->
    <div class="row g-4">
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
                                <p class=" mb-0 small">Ukończono pierwszy trening</p>
                            </div>
                    <?php endif; ?>
                    
                    <?php if ($trainingCount >= 5): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-medal text-white"></i>
                            </div>
                            <div>
                                <strong>Na fali!</strong>
                                <p class=" mb-0 small">5 ukończonych treningów</p>
                            </div>
                    <?php endif; ?>
                    
                    <?php if ($restCount >= 3): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                            <div>
                                <strong>Dbaj o siebie!</strong>
                                <p class=" mb-0 small">3 wpisy odpoczynku</p>
                            </div>
                    <?php endif; ?>
                    
                    <?php if ($trainingCount < 1 && $restCount < 1): ?>
                        <div class="text-center py-4">
                            <i class="fas fa-trophy fa-3x  mb-3"></i>
                            <p >Zacznij trenować aby odblokować osiągnięcia!</p>
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
.stat-btn {
    background: rgba(255, 255, 255, 0.1);
    color: #e2e8f0;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}
.stat-btn:hover, .stat-btn.active {
    background: rgba(255, 255, 255, 0.2);
    color: #fff;
    border-color: rgba(255, 255, 255, 0.4);
}
.stat-value {
    transition: all 0.5s ease;
}
</style>

<script>
function changeStat(btn, value, label, color) {
    // Update buttons
    document.querySelectorAll('.stat-btn').forEach(function(b) {
        b.classList.remove('active');
    });
    btn.classList.add('active');
    
    // Update value with animation
    var statValue = document.getElementById('mainStatValue');
    statValue.style.color = color;
    statValue.style.transform = 'scale(0.8)';
    statValue.style.opacity = '0';
    
    setTimeout(function() {
        statValue.textContent = value;
        statValue.style.transform = 'scale(1)';
        statValue.style.opacity = '1';
    }, 150);
    
    // Update label
    document.getElementById('mainStatLabel').textContent = label;
}
</script>
