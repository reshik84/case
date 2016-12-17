<?php

return [
    'class' => 'dektrium\user\Module',
//    'admins' => ['admin'],
    'modelMap' => [
        'User' => 'app\models\User',
        'RegistrationForm' => 'app\models\RegistrationForm',
    ],
    'controllerMap' => [
        'admin' => [
            'class' => 'dektrium\user\controllers\AdminController',
            'layout' => '//admin',
        ],
    ],
    'enableConfirmation' => FALSE,
];
