<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\RegistrationForm $model */

$this->title = 'Rejestracja';
?>

<!-- Register Section -->
<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="login-card">
                    <div class="text-center mb-4">
                        <i class="fas fa-user-plus fa-4x icon-primary"></i>
                        <h2 class="mt-3">Zarejestruj się</h2>
                        <p class="text-muted">Stwórz nowe konto</p>
                    </div>
                    
                    <?php $form = ActiveForm::begin([
                        'id' => 'register-form',
                        'action' => ['/site/register'],
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
                        <?= $form->field($model, 'email')->textInput([
                            'placeholder' => 'Adres e-mail'
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Hasło']) ?>
                    </div>

                    <div class="mb-4">
                        <?= $form->field($model, 'password_repeat')->passwordInput(['placeholder' => 'Powtórz hasło']) ?>
                    </div>

                    <div class="d-grid gap-2">
                        <?= Html::submitButton('<i class="fas fa-user-plus me-2"></i>Zarejestruj', ['class' => 'btn btn-primary btn-lg', 'name' => 'register-button']) ?>
                        <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Powrót', ['/site/index'], ['class' => 'btn btn-outline-secondary']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                    
                    <div class="text-center mt-4 text-muted-light">
                        Masz już konto? <strong><?= Html::a('Zaloguj się', ['/site/login'], ['class' => 'link-primary-bold']) ?></strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

