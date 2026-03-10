<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'E-sportowy planer';
?>

<!-- Hero Section -->
<section class="hero-section" id="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="hero-title">E-sport Planer</h1>
                <p class="hero-subtitle">Zarządzaj swoim czasem, trenuj mądrze i osiągaj sukcesy w ulubionych grach</p>
                
    
            </div>
        </div>
        
        <!-- Feature Cards (only for logged in users) -->
        <?php if (!Yii::$app->user->isGuest): ?>
        <div class="row g-4 mt-3">            <!-- Training Card -->
            <div class="col-lg-4 col-md-6">
                <a href="<?= Url::to(['training/index']) ?>" class="text-decoration-none">
                    <div class="feature-card training-card">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-bullseye fa-2x icon-green"></i>
                        </div>
                        <h2>Treningi</h2>
                        <p>Planuj i monitoruj sesje treningowe. Śledź swój progres i osiągaj nowe levele.</p>
                        <div class="card-stats">
                            <span class="stat-badge"><i class="fas fa-clock me-1"></i>Godziny nauki</span>
                            <span class="stat-badge"><i class="fas fa-clipboard-list me-1"></i>Sesje</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Rest Card -->
            <div class="col-lg-4 col-md-6">
                <a href="<?= Url::to(['rest/index']) ?>" class="text-decoration-none">
                    <div class="feature-card rest-card">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-moon fa-2x icon-purple"></i>
                        </div>
                        <h2>Odpoczynek</h2>
                        <p>Zadbaj o regenerację i zdrowie. Właściwy odpoczynek to klucz do sukcesu.</p>
                        <div class="card-stats">
                            <span class="stat-badge"><i class="fas fa-bed me-1"></i>Godziny snu</span>
                            <span class="stat-badge"><i class="fas fa-coffee me-1"></i>Przerwy</span>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Stats Card -->
            <div class="col-lg-4 col-md-6">
                <a href="<?= Url::to(['stats/index']) ?>" class="text-decoration-none">
                    <div class="feature-card stats-card">
                        <div class="icon-wrapper mb-3">
                            <i class="fas fa-chart-line fa-2x icon-amber"></i>
                        </div>
                        <h2>Statystyki</h2>
                        <p>Analizuj postępy z detailowymi raportami i wykresami wydajności.</p>
                        <div class="card-stats">
                            <span class="stat-badge"><i class="fas fa-file-alt me-1"></i>Raporty</span>
                            <span class="stat-badge"><i class="fas fa-chart-pie me-1"></i>Wykresy</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

