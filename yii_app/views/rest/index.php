<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var \app\models\extended\Rest $model */
/** @var \app\models\extended\Rest[] $restList */

$this->title = 'Odpoczynek';
?>

<div class="rest-index">
    <!-- Page Header -->
    <div class="page-header slide-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1><i class="fas fa-moon me-2 icon-purple"></i><?= Html::encode($this->title) ?></h1>
                <p class="mb-0">Zarządzaj czasem odpoczynku i regeneracji</p>
            </div>
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
            <div class="card slide-up animation-delay-1">
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
            </div>

            <!-- Tips Card -->
            <div class="card mt-4 slide-up animation-delay-2">
                <div class="card-header">
                    <i class="fas fa-heart me-2"></i>Dlaczego odpoczynek jest ważny?
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class="fas fa-brain text-info me-2"></i>
                            <span>Odpoczynek poprawia koncentrację</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-bolt text-warning me-2"></i>
                            <span>Zwiększa refleks</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-smile text-success me-2"></i>
                            <span>Zmniejsza stres i wypalenie</span>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-chart-line text-primary me-2"></i>
                            <span>Pomaga w utrzymaniu formy</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Rest Content -->
        <div class="col-lg-7">
            <?php if (!empty($restList)): ?>
                <!-- Rest Stats with Progress Bar -->
                <div class="card slide-up animation-delay-3 mb-4">
                    <div class="card-header">
                        <i class="fas fa-chart-line me-2"></i>Postępy w odpoczynku
                    </div>
                    <div class="card-body">
                        <?php 
                        $restCount = count($restList);
                        $sleepCount = count(array_filter($restList, function($e) { return stripos($e->rest_type, 'sen') !== false; }));
                        ?>
                        
                        <!-- Progress bar for rest goal -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span><i class="fas fa-moon me-2 text-purple"></i><strong>Cel: 7 dni odpoczynku</strong></span>
                                <span class="badge bg-purple"><?= $restCount ?>/7</span>
                            </div>
                            <div class="progress progress-lg">
                                <div class="progress-bar bg-purple" role="progressbar" style="width: <?= min($restCount * 15, 100) ?>%;" aria-valuenow="<?= $restCount ?>" aria-valuemin="0" aria-valuemax="7">
                                    <?= min($restCount * 15, 100) ?>%
                                </div>
                            </div>
                        </div>
                        
                        <!-- Stats boxes -->
                        <div class="row text-center mt-4">
                            <div class="col-6">
                                <div class="stat-box p-3 rounded">
                                    <i class="fas fa-moon fa-2x text-purple mb-2"></i>
                                    <h4 class="mb-0"><?= $restCount ?></h4>
                                    <small>Wpisów</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="stat-box p-3 rounded">
                                    <i class="fas fa-bed fa-2x text-primary mb-2"></i>
                                    <h4 class="mb-0"><?= $sleepCount ?></h4>
                                    <small>Sesje snu</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rest Types -->
                <?php 
                $restTypes = array_count_values(array_column($restList, 'rest_type'));
                arsort($restTypes);
                if (!empty($restTypes)): 
                ?>
                <div class="card slide-up animation-delay-4 mb-4">
                    <div class="card-header">
                        <i class="fas fa-tags me-2"></i>Rodzaje odpoczynku
                    </div>
                    <div class="card-body">
                        <?php foreach (array_slice($restTypes, 0, 5) as $type => $count): ?>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span><i class="fas fa-moon me-2 text-purple"></i><?= Html::encode($type) ?></span>
                                <span class="badge bg-purple"><?= $count ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Rest List -->
                <div class="card slide-up animation-delay-5">
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
                                                <span class="badge bg-purple badge-rest-date">
                                                    <i class="fas fa-calendar-day me-1"></i>
                                                    <?= Html::encode($entry->date) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <i class="fas fa-moon me-2 icon-purple"></i>
                                                <strong><?= Html::encode($entry->rest_type) ?></strong>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="card slide-up">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-moon fa-4x mb-3"></i>
                        <h4>Brak zapisanych odpoczynków</h4>
                        <p>Pamiętaj o regeneracji!</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Wróć do strony głównej', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
</div>

