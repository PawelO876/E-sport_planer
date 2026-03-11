<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\extended\PasswordResetRequestForm $model */

$this->title = 'Resetowanie hasła';
?>

<div class="site-request-password-reset">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <h1 class="h3 mb-3 fw-normal text-center">Resetowanie hasła</h1>
                    <p class="text-center mb-4">
                        Podaj adres email, a wyślemy Ci link do zresetowania hasła.
                    </p>

                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email', [
                        'inputOptions' => ['autocomplete' => 'email', 'class' => 'form-control'],
                    ])->textInput(['autofocus' => true, 'placeholder' => 'Adres email'])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Wyślij link', ['class' => 'btn btn-primary w-100']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                    <div class="text-center mt-3">
                        <a href="<?= \yii\helpers\Url::to(['site/login']) ?>">Wróć do logowania</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

