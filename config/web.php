<?php

require(__DIR__ . '/events.php');

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'FYz0ndQu5QiHI7wYc_wUyrKlEdsGXNsS',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                    [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'admin/settings/<action>' => 'settings/manager/<action>',
                'admin/settings' => 'settings/manager',
                'admin/<module>/<action>' => '<module>/admin/<action>',
            ],
        ],
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
        ],
        'freeKassa' => [
            'class' => '\yarcode\freekassa\Merchant',
            'merchantId' => '41527',
            'merchantFormSecret' => 'rpqzmvs3',
            'checkDataSecret' => 'xtfs3kog',
            'defaultLanguage' => 'ru' // or 'en' 
        ],
        'freeKassa_api' => [
            'class' => '\yarcode\freekassa\Api',
            'merchantId' => '41527',
            'walletId' => 'F101302758',
            'apiKey' => '58C9F44BCD7D9D38EED28E457845A9E1'
        ],
        'settings'=>[ 
             'class'=>'johnitvn\settings\components\Settings' 
        ],
        'websocket' => [
            'class' => 'app\websocket\Client',
            'url' => 'tcp://127.0.0.1:8004',
        ],
        'authClientCollection' => [
            'class' => yii\authclient\Collection::className(),
            'clients' => [
                'vkontakte' => [
                    'class' => 'dektrium\user\clients\VKontakte',
//                    'clientId' => '5815475',
//                    'clientSecret' => 'vIF2E6zpsxAQDJ0D7ZCG',
                    'clientId' => '5814773',
                    'clientSecret' => 'hZOV7hapgbg9KFVJos3b',
                ],
            ],
        ],
    ],
    'params' => $params,
    'modules' => [
        'user' => require(__DIR__ . '/module_user.php'),
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'cases' => [
            'class' => 'app\modules\cases\Module',
        ],
        'operations' => [
            'class' => 'app\modules\operations\Module',
        ],
        'settings' => [ 
            'class'=>'johnitvn\settings\Module', 
            'as Access' => require (__DIR__ . '/access.php'),
            'layout' => '//admin',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
