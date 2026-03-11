<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\extended\LoginForm $model */

$this->title = 'Logowanie';
?>

<!-- Login Section -->
<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-card">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-4x icon-primary"></i>
                        <h2 class="mt-3">Zaloguj się</h2>
                        <p>Wpisz swoje dane aby kontynuować</p>
                    </div>
                    
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'action' => ['/site/login'],
                        'fieldConfig' => [
                            'template' => "{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'form-label'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['class' => 'invalid-feedback'],
                        ],
                    ]); ?>

                    <div class="mb-3">
                        <?= $form->field($model, 'username')->textInput([
                            'autofocus' => true, 
                            'placeholder' => 'Nazwa użytkownika'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Hasło']) ?>
                    </div>

                    <div class="mb-4">
                        <?= $form->field($model, 'rememberMe')->checkbox([
                            'template' => "<div class=\"form-check\">{input} {label}</div>\n<div class=\"invalid-feedback\">{error}</div>",
                        ]) ?>
                    </div>

                    <div class="d-grid gap-2">
                        <?= Html::submitButton('<i class="fas fa-sign-in-alt me-2"></i>Zaloguj', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>
                        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Powrót', ['site/index'], ['class' => 'btn btn-outline-secondary']) ?>
                        
                    </div>

                    <?php ActiveForm::end(); ?>
                    
                    <div class="text-center mt-4">
                        <small><?= Html::a('Zapomniałeś hasła?', ['site/request-password-reset']) ?></small>
                    </div>
                    
                    <div class="text-center mt-2">
                        Nie masz jeszcze konta? <strong><?= Html::a('Zarejestruj się', ['site/register']) ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

