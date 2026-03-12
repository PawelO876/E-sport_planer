<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\extended\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Contact';
// Replace default breadcrumbs with just the page title (removes "Home")
$this->params['breadcrumbs'] = [$this->title];
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>


        <div class="row">
            <div class="col-lg-5">

                <?php
                // provide sample values for demonstration
                if (!$model->name) {
                    $model->name = 'Paweł Olczak';
                }
                if (!$model->email) {
                    $model->email = 'pawel.olczak@example.com';
                }
                // phone digits 1-9 included in body
                if (!$model->body) {
                    $model->body = 'Telefon: 123456789\n' . 'Tutaj wpisz swoją wiadomość.';
                }
                $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>


                    <div class="form-group">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>

</div>
