<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\LoginForm $loginModel */

// Create an empty LoginForm model if not set
if (!isset($loginModel)) {
    $loginModel = new \app\models\LoginForm();
}

$this->title = 'E-sportowy planer';
?>

<!-- Hero Section -->
<section class="hero-section" id="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h1 class="hero-title">E-sport Planer</h1>
                <p class="hero-subtitle">Zarządzaj swoim czasem, trenuj mądrze i osiągaj sukcesy w ulubionych grach</p>
                    <button class="btn btn-primary btn-lg" id="start-btn">
                    <i class="fas fa-gamepad me-2"></i>Zacznij teraz
                </button>
            </div>
        </div>
        
        <!-- Feature Cards -->
        <div class="row g-4 mt-5">
            <!-- Training Card -->
            <div class="col-lg-4 col-md-6">
                <a href="<?= Url::to(['/training/index']) ?>" class="text-decoration-none">
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
                <a href="<?= Url::to(['/rest/index']) ?>" class="text-decoration-none">
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
                <a href="<?= Url::to(['/stats/index']) ?>" class="text-decoration-none">
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
    </div>
</section>

<!-- Login Section -->
<section class="login-section py-5" id="login-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-card">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-4x icon-primary"></i>
                        <h2 class="mt-3">Zaloguj się</h2>
                        <p class="text-muted">Wpisz swoje dane aby kontynuować</p>
                    </div>
                    
                    <?php $form = ActiveForm::begin([
                        'id' => 'inline-login-form',
                        'action' => ['/site/login'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ],
                    ]); ?>

                    <div class="mb-3">
                        <?= $form->field($loginModel, 'username')->textInput([
                            'autofocus' => true, 
                            'placeholder' => 'Nazwa użytkownika'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $form->field($loginModel, 'password')->passwordInput(['placeholder' => 'Hasło']) ?>
                    </div>

                    <div class="mb-4">
                        <?= $form->field($loginModel, 'rememberMe')->checkbox([
                            'template' => "<div class=\"form-check\">{input} {label}</div>\n<div class=\"invalid-feedback\">{error}</div>",
                        ]) ?>
                    </div>

                    <div class="d-grid gap-2">
                        <?= Html::submitButton('<i class="fas fa-sign-in-alt me-2"></i>Zaloguj', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
                        <button type="button" class="btn btn-outline-secondary" id="back-btn">
                            <i class="fas fa-arrow-left me-2"></i>Wróć
                        </button>
                    </div>

                    <?php ActiveForm::end(); ?>
                    
                    <div class="text-center mt-4 text-muted-lighter">
                        Nie masz jeszcze konta? <strong><?= Html::a('Zarejestruj się', ['/site/register'], ['class' => 'link-primary-bold']) ?></strong>
                    </div>
            </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var startBtn = document.getElementById('start-btn');
    var backBtn = document.getElementById('back-btn');
    var heroSection = document.getElementById('hero-section');
    var loginSection = document.getElementById('login-section');
    
    if (startBtn && heroSection && loginSection) {
        startBtn.addEventListener('click', function() {
            heroSection.style.display = 'none';
            loginSection.style.display = 'block';
            loginSection.classList.add('fade-in');
        });
        
        backBtn.addEventListener('click', function() {
            loginSection.style.display = 'none';
            heroSection.style.display = 'block';
        });
    }
});
</script>
