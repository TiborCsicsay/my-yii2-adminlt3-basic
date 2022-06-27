<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$translateManager = require __DIR__ . '/modules/translateManager.php';
$i18n = require __DIR__ . '/components/i18n.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'modules'=>[
        'user-management' => [
            'class' => 'app\modules\usermanagement\UserManagementModule',
            'controllerNamespace'=>'app\modules\usermanagement\controllers', // To prevent yii help from crashing
        ],
        'translatemanager' => $translateManager
    ],
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
        'db' => $db,
        'i18n' => $i18n,
    ],
    'controllerMap' => [
        'migrate-translate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration__translate',
            'migrationPath' => '@app/migrations/translatemanager'
        ],
        'migrate-user' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationTable' => 'migration__user',
            'migrationPath' => '@app/migrations/usermanagement'
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
