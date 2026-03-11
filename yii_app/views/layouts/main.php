<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/jpeg', 'href' => Yii::getAlias('@web/ikona.jpg')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Apply theme immediately to prevent flash -->
    <script>
        // Apply theme and set icon immediately
        (function() {
            if (localStorage.getItem('theme') === 'light') {
                document.write('<style>body{background:#f0f4f8;color:#2d3748}body.light-mode{background:#f0f4f8;color:#2d3748}body.light-mode .card{background:#fff;border-color:#e2e8f0}body.light-mode .navbar{background:rgba(255,255,255,0.95)!important;border-bottom-color:#e2e8f0}body.light-mode .nav-link{color:#2d3748!important}body.light-mode .footer-custom{background:rgba(255,255,255,0.95)!important;border-top-color:#e2e8f0}body.light-mode .page-header{background:#fff;border-color:#e2e8f0}body.light-mode .form-control{background:#f7fafc;border-color:#e2e8f0;color:#2d3748}body.light-mode .stat-box{background:#f7fafc!important;border-color:#e2e8f0}body.light-mode .table{color:#2d3748}body.light-mode .table thead th{background:#f7fafc;color:#2d3748;border-bottom-color:#e2e8f0}body.light-mode .table tbody tr{background:#fff;border-bottom-color:#e2e8f0}body.light-mode .feature-card{background:#fff;border-color:#e2e8f0}body.light-mode .login-section{background:#fff;border-color:#e2e8f0}body.light-mode h1,body.light-mode h2,body.light-mode h3,body.light-mode h4,body.light-mode h5,body.light-mode h6{color:#2d3748!important}body.light-mode footer span{color:#2d3748!important}body.light-mode .card-body{color:#2d3748}body.light-mode .stat-box h4{color:#2d3748!important}body.light-mode .stat-box small{color:#718096!important}body.light-mode .form-label{color:#2d3748}body.light-mode .form-check-label{color:#718096}body.light-mode .feature-card p{color:#718096}body.light-mode .feature-card h2{color:#2d3748}body.light-mode .login-card h2{color:#2d3748}body.light-mode .btn-outline-secondary{border-color:#e2e8f0;color:#2d3748}body.light-mode #theme-toggle{color:#2d3748}body.light-mode #theme-icon.fa-moon{display:none}body.light-mode #theme-icon.fa-sun{display:inline}#theme-icon.fa-sun{display:none}</style>');
                document.body.classList.add('light-mode');
            }
        })();
    </script>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top navbar-custom">
    <div class="container-fluid px-0">
<!-- Theme Toggle Button -->
        <button class="btn btn-link nav-link me-2" id="theme-toggle" title="Zmień motyw">
            <i id="theme-icon-moon" class="fas fa-moon"></i>
            <i id="theme-icon-sun" class="fas fa-sun" style="display:none;"></i>
        </button>
        <script>
            (function() {
                if (localStorage.getItem('theme') === 'light') {
                    document.getElementById('theme-icon-moon').style.display = 'none';
                    document.getElementById('theme-icon-sun').style.display = 'inline';
                }
            })();
        </script>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav w-100 justify-content-around">
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['site/index']) ?>">
                        <i class="fas fa-home me-1"></i> <?= Html::encode('Start') ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= Url::to(['site/contact']) ?>">
                        <i class="fas fa-envelope me-1"></i> <?= Html::encode('Kontakt') ?>
                    </a>
                </li>
                <?php if (Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['site/login']) ?>">
                            <i class="fas fa-sign-in-alt me-1"></i> <?= Html::encode('Logowanie') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['site/register']) ?>">
                            <i class="fas fa-user-plus me-1"></i> <?= Html::encode('Rejestracja') ?>
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['training/index']) ?>">
                            <i class="fas fa-bullseye me-1"></i> <?= Html::encode('Treningi') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['rest/index']) ?>">
                            <i class="fas fa-moon me-1"></i> <?= Html::encode('Odpoczynek') ?>
                        </a>
                    </li>
                <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['stats/index']) ?>">
                            <i class="fas fa-chart-line me-1"></i> <?= Html::encode('Statystyki') ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['site/my-messages']) ?>">
                            <i class="fas fa-envelope me-1"></i> <?= Html::encode('Wiadomości') ?>
                        </a>
                    </li>
                    <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin()): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Url::to(['admin/index']) ?>">
                            <i class="fas fa-cog me-1"></i> <?= Html::encode('Admin') ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <?= Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline']) ?>
                            <button type="submit" class="nav-link btn btn-link logout">
                                <i class="fas fa-sign-out-alt me-1"></i> Logout (<?= Html::encode(Yii::$app->user->identity->username) ?>)
                            </button>
                        <?= Html::endForm() ?>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
</nav>

<!-- Main Content -->
<main class="flex-shrink-0 main-content-padding" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<!-- Footer -->
<footer class="mt-auto py-4 footer-custom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start">
                <span>
                    <i class="fas fa-gamepad me-2 icon-primary"></i>
                    &copy; <?= date('Y') ?> E-sport Planer. Wszelkie prawa zastrzeżone.
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <span>
                    Made with <i class="fas fa-heart text-danger mx-1"></i> for gamers
                </span>
            </div>
    </div>
</footer>

<?php $this->endBody() ?>

<!-- Theme Toggle Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    var themeToggle = document.getElementById('theme-toggle');
    var themeIconMoon = document.getElementById('theme-icon-moon');
    var themeIconSun = document.getElementById('theme-icon-sun');
    
    // Check for saved theme preference and apply immediately
    var savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'light') {
        document.body.classList.add('light-mode');
    }
    
    themeToggle.addEventListener('click', function() {
        document.body.classList.toggle('light-mode');
        
        if (document.body.classList.contains('light-mode')) {
            themeIconMoon.style.display = 'none';
            themeIconSun.style.display = 'inline';
            localStorage.setItem('theme', 'light');
        } else {
            themeIconMoon.style.display = 'inline';
            themeIconSun.style.display = 'none';
            localStorage.setItem('theme', 'dark');
        }
    });
});
</script>

</body>
</html>
<?php $this->endPage() ?>
