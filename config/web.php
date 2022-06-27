<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$translateManager = require __DIR__ . '/modules/translateManager.php';
$i18n = require __DIR__ . '/components/i18n.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'user-management' => [
            'class' => 'app\modules\usermanagement\UserManagementModule',
            'userCanHaveMultipleRoles' => false,

            // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
            // The example below allows user to enter :
            // any set of characters
            // (?=\S{8,}): of at least length 8
            // (?=\S*[a-z]): containing at least one lowercase letter
            // (?=\S*[A-Z]): and at least one uppercase letter
            // (?=\S*[\d]): and at least one number
            // $: anchored to the end of the string

            //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$',
        ],
        'admin' => [
            'class' => 'app\modules\admin\Module',
        ],
        'translatemanager' => $translateManager
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'k9VOqLOmwbZDCeeIGilyKgQJHGOusTtj',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'webvimark\modules\UserManagement\components\UserConfig',

            // Comment this if you don't want to record user logins
            'on afterLogin' => function ($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
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
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => $_ENV['MAILER_HOST'],
                'username' => $_ENV['MAILER_USERNAME'],
                'password' => $_ENV['MAILER_PASSWORD'],
                'port' => $_ENV['MAILER_PORT'],
                'encryption' => $_ENV['MAILER_ENCRYPTION'],
            ]
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
        'db' => $db,
        'i18n' => $i18n,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
        'generators' => [ //here
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'CssDefault' => '@app/components/gii/generators/crud/CssDefault', // template name => path to template
                    'CssWithFileUpload' => '@app/components/gii/generators/crud/CssWithFileUpload', // template name => path to template
                ]
            ],
            'model' => [ // generator name
                'class' => 'yii\gii\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'CssDefault' => '@app/components/gii/generators/model/CssDefault', // template name => path to template
                    'CssWithFileUpload' => '@app/components/gii/generators/model/CssWithFileUpload', // template name => path to template
                ]
            ],
            'controller' => [ // generator name
                'class' => 'yii\gii\generators\controller\Generator', // generator class
                'templates' => [ //setting for out templates
                    'CssDefault' => '@app/components/gii/generators/controller/CssDefault', // template name => path to template
                    'CssWithFileUpload' => '@app/components/gii/generators/controller/CssWithFileUpload', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;
