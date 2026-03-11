<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\extended\Message $model */

$this->title = 'Edytuj wiadomość';
?>

<!-- Update Message Section -->
<section class="update-message-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="mb-4"><?= Html::encode($this->title) ?></h1>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fas fa-save me-2"></i>Zapisz', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="fas fa-arrow-left me-2"></i>Powrót', ['site/my-messages'], ['class' => 'btn btn-outline-secondary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</section>

