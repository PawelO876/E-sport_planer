<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $userCount int */
/* @var $messageCount int */
/* @var $unreadMessageCount int */

$this->title = 'Panel Administratora';
?>

<div class="admin-index">
    <h1><?= Html::encode($this->title) ?></h1>
    
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-users"></i> Użytkownicy
                    </h5>
                    <p class="card-text">
                        <strong><?= $userCount ?></strong> użytkowników w systemie
                    </p>
                    <?= Html::a('Zarządzaj użytkownikami', ['users'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <i class="fas fa-envelope"></i> Wiadomości
                    </h5>
                    <p class="card-text">
                        <strong><?= $messageCount ?></strong> wiadomości<br>
                        <span class="text-danger"><?= $unreadMessageCount ?> nieprzeczytanych</span>
                    </p>
                    <?= Html::a('Zarządzaj wiadomościami', ['messages'], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-3">
        <?= Html::a('<i class="fas fa-arrow-left"></i> Wróć do strony głównej', ['/site/index'], ['class' => 'btn btn-secondary']) ?>
    </div>
</div>

