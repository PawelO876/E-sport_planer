<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\extended\Training;
use app\models\extended\Rest;

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
    </div>

    <!-- Main Stat Card -->
    <div class="card slide-up mb-4 dark-gradient-card">
        <div class="card-body text-center py-5">
            <div class="main-stat-value" id="mainStatValue">
                <?= $trainingCount ?>
            </div>
            <p class="mb-3 main-stat-label" id="mainStatLabel">Treningów</p>
            
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
            <div class="card slide-up animation-delay-5">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-2"></i>Postępy
                </div>
                <div class="card-body">
                    <!-- Training Progress -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-bullseye me-2 text-success"></i><strong>Treningi</strong></span>
                            <span class="badge bg-success"><?= $trainingCount ?>/10</span>
                        </div>
                        <div class="progress" style="height: 24px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: <?= min($trainingCount * 10, 100) ?>%;" aria-valuenow="<?= $trainingCount ?>" aria-valuemin="0" aria-valuemax="10">
                                <?= min($trainingCount * 10, 100) ?>%
                            </div>
                        </div>
                        <p class="small mt-1">Cel: 10 treningów</p>
                    </div>
                    
                    <!-- Rest Progress -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span><i class="fas fa-moon me-2 text-purple"></i><strong>Odpoczynek</strong></span>
                            <span class="badge bg-purple"><?= $restCount ?>/7</span>
                        </div>
                        <div class="progress" style="height: 24px;">
                            <div class="progress-bar bg-purple" role="progressbar" style="width: <?= min($restCount * 15, 100) ?>%;" aria-valuenow="<?= $restCount ?>" aria-valuemin="0" aria-valuemax="7">
                                <?= min($restCount * 15, 100) ?>%
                            </div>
                        </div>
                        <p class="small mt-1">Cel: 7 dni odpoczynku</p>
                    </div>
                    
                    <!-- Summary Stats -->
                    <div class="row text-center mt-4">
                        <div class="col-4">
                            <div class="stat-box p-3 rounded">
                                <i class="fas fa-bullseye fa-2x text-success mb-2"></i>
                                <h4 class="mb-0"><?= $trainingCount ?></h4>
                                <small>Treningów</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-box p-3 rounded">
                                <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                                <h4 class="mb-0"><?= $totalMinutes ?: 0 ?></h4>
                                <small>Minut</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stat-box p-3 rounded">
                                <i class="fas fa-moon fa-2x text-purple mb-2"></i>
                                <h4 class="mb-0"><?= $restCount ?></h4>
                                <small>Odpoczynków</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card slide-up animation-delay-6">
                <div class="card-header">
                    <i class="fas fa-star me-2"></i>Twoje osiągnięcia
                </div>
                <div class="card-body">
                    <?php if ($trainingCount >= 1): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 icon-box ach-icon-gold">
                                <i class="fas fa-fire text-white"></i>
                            </div>
                            <div>
                                <strong>Pierwszy krok!</strong>
                                <p class="mb-0 small">Ukończono pierwszy trening</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($trainingCount >= 5): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 icon-box ach-icon-green">
                                <i class="fas fa-medal text-white"></i>
                            </div>
                            <div>
                                <strong>Na fali!</strong>
                                <p class="mb-0 small">5 ukończonych treningów</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($restCount >= 3): ?>
                        <div class="d-flex align-items-center mb-3">
                            <div class="me-3 icon-box ach-icon-purple">
                                <i class="fas fa-heart text-white"></i>
                            </div>
                            <div>
                                <strong>Dbaj o siebie!</strong>
                                <p class="mb-0 small">3 wpisy odpoczynku</p>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($trainingCount < 1 && $restCount < 1): ?>
                        <div class="text-center py-4">
                            <i class="fas fa-trophy fa-3x mb-3"></i>
                            <p>Zacznij trenować aby odblokować osiągnięcia!</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="card mt-4 slide-up animation-delay-7">
        <div class="card-header">
            <i class="fas fa-bolt me-2"></i>Szybkie działania
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <?= Html::a('<i class="fas fa-plus me-2"></i>Dodaj trening', ['/training/create'], ['class' => 'btn btn-success w-100']) ?>
                </div>
                <div class="col-md-4">
                    <?= Html::a('<i class="fas fa-moon me-2"></i>Dodaj odpoczynek', ['/rest/index'], ['class' => 'btn btn-primary w-100 btn-gradient-purple']) ?>
                </div>
                <div class="col-md-4">
                    <?= Html::a('<i class="fas fa-history me-2"></i>Historia treningów', ['/training/index'], ['class' => 'btn btn-outline-secondary w-100']) ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Wróć do strony głównej', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>

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

