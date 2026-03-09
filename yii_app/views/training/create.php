<?php

/* @var yii\web\View $this */
/* @var app\models\Training $training */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Nowy trening';
?>

<div class="training-create">
    <!-- Page Header -->
    <div class="page-header slide-up">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1><i class="fas fa-plus-circle me-2 icon-green"></i><?= Html::encode($this->title) ?></h1>
                <p class="text-muted mb-0">Dodaj nowy trening do swojego planu</p>
            </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card slide-up animation-delay-1">
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                        'options' => ['class' => 'training-form'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ],
                    ]); ?>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <?= $form->field($training, 'date')->input('date', [
                                'class' => 'form-control',
                                'placeholder' => 'Wybierz datę'
                            ])->label('<i class="fas fa-calendar me-2"></i>Data treningu') ?>
                        </div>
                        
                        <div class="col-md-6">
                            <?= $form->field($training, 'duration')->input('number', [
                                'class' => 'form-control',
                                'placeholder' => 'Czas w minutach',
                                'min' => 1
                            ])->label('<i class="fas fa-clock me-2"></i>Czas trwania (minuty)') ?>
                        </div>
                        
                        <div class="col-md-6">
                            <?= $form->field($training, 'game')->textInput([
                                'class' => 'form-control',
                                'placeholder' => 'np. CS2, Valorant, LoL'
                            ])->label('<i class="fas fa-gamepad me-2"></i>Gra') ?>
                        </div>
                        
                        <div class="col-md-6">
                            <?= $form->field($training, 'training_type')->textInput([
                                'class' => 'form-control',
                                'placeholder' => 'np. Aim, Taktika, Warmup'
                            ])->label('<i class="fas fa-tags me-2"></i>Typ treningu') ?>
                        </div>

                    <div class="form-group mt-4">
                        <?= Html::submitButton('<i class="fas fa-save me-2"></i>Zapisz trening', ['class' => 'btn btn-success btn-lg']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card slide-up animation-delay-3">
                <div class="card-header">
                    <i class="fas fa-lightbulb me-2"></i>Wskazówki
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Regularny trening jest kluczem do sukcesu</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Pamiętaj o rozgrzewce przed każdą sesją</span>
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Notuj swoje postępy i analizuj je</span>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check-circle text-success me-2"></i>
                            <span>Rób przerwy aby uniknąć wypalenia</span>
                        </li>
                    </ul>
                </div>
        </div>
    
    <!-- Back Button -->
    <div class="mt-4">
        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Powrót do listy treningów', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
