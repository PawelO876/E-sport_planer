<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\extended\PasswordResetForm $model */

$this->title = 'Nowe hasło';
?>

<div class="site-reset-password">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-3 fw-normal text-center">Ustaw nowe hasło</h1>
                    <p class="text-center mb-4">
                        Wprowadź nowe hasło dla swojego konta.
                    </p>

                    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->field($model, 'password', [
                        'inputOptions' => ['autocomplete' => 'new-password', 'class' => 'form-control'],
                    ])->passwordInput(['placeholder' => 'Nowe hasło'])->label(false) ?>

                    <?= $form->field($model, 'password_confirm', [
                        'inputOptions' => ['autocomplete' => 'new-password', 'class' => 'form-control'],
                    ])->passwordInput(['placeholder' => 'Powtórz hasło'])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Zmień hasło', ['class' => 'btn btn-primary w-100']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

