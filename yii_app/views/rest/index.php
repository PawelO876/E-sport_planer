<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\models\Rest $model */
/** @var \app\models\Rest[] $restList */

$this->title = 'Odpoczynek';
?>

<div class="rest-index">
    <!-- Page Header -->
    <div class="page-header slide-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1><i class="fas fa-moon me-2" style="color: #8b5cf6;"></i><?= Html::encode($this->title) ?></h1>
                <p class="text-muted mb-0">Zarządzaj czasem odpoczynku i regeneracji</p>
            </div>
    </div>

    <!-- Alert Messages -->
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success fade-in">
            <i class="fas fa-check-circle me-2"></i><?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <div class="row g-4">
        <!-- Add Rest Form -->
        <div class="col-lg-5">
            <div class="card slide-up" style="animation-delay: 0.1s;">
                <div class="card-header">
                    <i class="fas fa-plus-circle me-2"></i>Dodaj wpis
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ],
                    ]); ?>

                    <div class="mb-3">
                        <?= $form->field($model, 'rest_type')->textInput([
                            'maxlength' => true,
                            'placeholder' => 'np. Sen, Przerwa, Regeneracja'
                        ])->label('<i class="fas fa-tags me-2"></i>Typ odpoczynku') ?>
                    </div>

                    <div class="mb-3">
                        <?= $form->field($model, 'date')->input('date')->label('<i class="fas fa-calendar me-2"></i>Data') ?>
                    </div>

                    <div class="form-group mt-4">
                        <?= Html::submitButton('<i class="fas fa-save me-2"></i>Zapisz', ['class' => 'btn btn-primary w-100']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

            <!-- Tips Card -->
            <div class="card mt-4 slide-up" style="animation-delay: 0.15s;">
                <div class="card-header">
                    <i class="fas fa-heart me-2"></i>Dlaczego odpoczynek jest ważny?
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class="fas fa-brain text-info me-2"></i>
                            <span class="text-muted">Odpoczynek poprawia koncentrację</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-bolt text-warning me-2"></i>
                            <span class="text-muted">Zwiększa reflexy i czas reakcji</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-smile text-success me-2"></i>
                            <span class="text-muted">Zmniejsza stres i wypalenie</span>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            <span class="text-muted">Pomaga w utrzymaniu formy</span>
                        </li>
                    </ul>
                </div>
        </div>

        <!-- Rest List -->
        <div class="col-lg-7">
            <?php if (!empty($restList)): ?>
                <div class="card slide-up" style="animation-delay: 0.2s;">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-list me-2"></i>Historia odpoczynku</span>
                        <span class="badge bg-primary"><?= count($restList) ?> wpisów</span>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th><i class="fas fa-calendar me-2"></i>Data</th>
                                        <th><i class="fas fa-tags me-2"></i>Typ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($restList as $entry): ?>
                                        <tr>
                                            <td>
                                                <span class="badge bg-purple" style="background: rgba(139, 92, 246, 0.2); color: #8b5cf6;">
                                                    <i class="fas fa-calendar-day me-1"></i>
                                                    <?= Html::encode($entry->date) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <i class="fas fa-moon me-2" style="color: #8b5cf6;"></i>
                                                <strong><?= Html::encode($entry->rest_type) ?></strong>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                </div>

                <!-- Rest Stats -->
                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <div class="card stat-card" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);">
                            <div class="card-body text-center text-white">
                                <i class="fas fa-clipboard-list fa-2x mb-2"></i>
                                <h3><?= count($restList) ?></h3>
                                <p class="mb-0">Łącznie wpisów</p>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card stat-card" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);">
                            <div class="card-body text-center text-white">
                                <i class="fas fa-bed fa-2x mb-2"></i>
                                <h3><?= count(array_filter($restList, function($e) { return stripos($e->rest_type, 'sen') !== false; })) ?></h3>
                                <p class="mb-0">Sesje snu</p>
                            </div>
                    </div>
            <?php else: ?>
                <div class="card slide-up">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-moon fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Brak zapisanych odpoczynków</h4>
                        <p class="text-muted">Pamiętaj o regeneracji!</p>
                    </div>
            <?php endif; ?>
        </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Wróć do strony głównej', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
