<?php

return [
    'class' => 'dektrium\user\Module',
//    'admins' => ['admin'],
    'modelMap' => [
        'User' => 'app\models\User',
    ],
    'controllerMap' => [
        'admin' => [
            'class' => 'dektrium\user\controllers\AdminController',
            'layout' => '//admin',
        ],
    ],
    'enableConfirmation' => FALSE,
];
