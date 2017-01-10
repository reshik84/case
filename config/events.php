<?php

use dektrium\user\controllers\SecurityController; 
use yii\base\Event;
use dektrium\user\events\AuthEvent;

Event::on(SecurityController::class, SecurityController::EVENT_AFTER_AUTHENTICATE, function (AuthEvent $e) {
    // if user account was not created we should not continue
    if ($e->account->user === null) {
        return;
    }

    // we are using switch here, because all networks provide different sets of data
    switch ($e->client->getName()) {
        case 'vkontakte':
            $e->account->user->updateAttributes([
                'username' => $e->client->getUserAttributes()['first_name'] . ' ' . $e->client->getUserAttributes()['last_name'],
                'balance' => 0
            ]);
    }

    // after saving all user attributes will be stored under account model
    // Yii::$app->identity->user->accounts['facebook']->decodedData
});