<?php

/** @var yii\web\View $this */

$this->title = 'E-sportowy planer';
?>

<div class="site-index">
    <!-- Hero Section -->
    <div class="hero-section text-center py-5">
        <h1 class="hero-title"> E-sport Planer</h1>
        <p class="hero-subtitle">Zarządzaj swoim czasem i osiągaj cele</p>
        <p><a class="btn btn-primary btn-lg" href="http://localhost:8081/index.php?r=site%2Flogin"> Zacznij teraz</a></p>
    </div>

    <!-- Stats Section -->
    <div class="body-content">
        <div class="row g-4 mb-5">
            <!-- Treningi Card -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card training-card">
                    
                    <h2>Treningi</h2>
                    <p>Zaplanuj i monitoruj swoje sesje treningowe. Śledzenie postępów i osiągnięć.</p>
                    <div class="card-stats">
                        <span class="stat-badge">Godziny nauki</span>
                        <span class="stat-badge">Sesje</span>
                    </div>
                </div>
            </div>

            <!-- Odpoczynek Card -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card rest-card">
                    <h2>Odpoczynek</h2>
                    <a href="/c/rest/index.php"></a>
                    <p>Zadbaj o regenerację i zdrowie. Zarządzaj czasem odpoczynku dla maksymalnej wydajności.</p>
                    <div class="card-stats">
                        <span class="stat-badge">Godziny snu</span>
                        <span class="stat-badge">Przerwy</span>
                    </div>
                </div>
            </div>

            <!-- Statystyki Card -->
            <div class="col-lg-4 col-md-6">
                <div class="feature-card stats-card">

                    <h2>Statystyki</h2>
                    <p>Analizuj swoje postępy z detailowymi raportami i wykresami wydajności.</p>
                    <div class="card-stats">
                        <span class="stat-badge">Raporty</span>
                        <span class="stat-badge">Wykresy</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
