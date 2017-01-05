<?php

$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'websocket' => [
            'class' => 'morozovsk\yii2websocket\Connection',
            'servers' => [
                'case' => [
                    'class' => 'app\websocket\cases\CaseWebsocketDaemonHandler',
                    'pid' => '/tmp/websocket_chat.pid',
                    'websocket' => 'tcp://127.0.0.1:8004',
                    'localsocket' => 'tcp://127.0.0.1:8010',
                    //'master' => 'tcp://127.0.0.1:8020',
                    //'eventDriver' => 'event'
                ]
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
    
    'controllerMap' => [
        'migrate' => [ // Fixture generation command line.
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'dektrium\user\migrations\Migration',
            ]
        ],
        'websocket' => 'morozovsk\yii2websocket\console\controllers\WebsocketController'
    ],
    
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
