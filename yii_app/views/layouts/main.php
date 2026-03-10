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
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-md navbar-dark fixed-top navbar-custom">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="<?= Yii::$app->homeUrl ?>">
            <i class="fas fa-gamepad me-2 icon-primary"></i>
            <?= Yii::$app->name ?>
        </a>
        
        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Nav Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
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
                            <i class="fas fa-sign-in-alt me-1"></i> <?= Html::encode('Zaloguj się') ?>
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
                <span class="text-muted">
                    <i class="fas fa-gamepad me-2 icon-primary"></i>
                    &copy; <?= date('Y') ?> E-sport Planer. Wszelkie prawa zastrzeżone.
                </span>
            </div>
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">
                <span class="text-muted">
                    Made with <i class="fas fa-heart text-danger mx-1"></i> for gamers
                </span>
            </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
