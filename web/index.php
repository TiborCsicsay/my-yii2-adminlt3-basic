<?php

$ip_address = $_SERVER['REMOTE_ADDR'];
$filtered_ips = require __DIR__ .'/../config/_ip_filter.php';

$envFilePath = __DIR__.'/../.env';

//using local environment
if ($_SERVER['SERVER_NAME'] === 'localhost'){
    if (file_exists(__DIR__.'/../.env.local')){
        $envFilePath = __DIR__.'/../.env.local';
    }else{
        throw new Exception('.env.local missing');
    }
}else{
    // limit access to ips
    if ($_ENV['APP_ENABLE_IPFILTER']){
        if (!in_array($ip_address,$filtered_ips)){
            exit;
        }
    }
}

// autoload classed \w composer
require __DIR__ . '/../vendor/autoload.php';

// load helper functions
require __DIR__ . '/../lib/helper_functions.php';

// load env config
$dotenv = new Symfony\Component\Dotenv\Dotenv;
$dotenv->load($envFilePath);

// define yii environment
if (in_array($_ENV['YII_ENVIRONMENT'],['dev','test']))
    defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', $_ENV['YII_ENVIRONMENT']);

// require Yii to reload Environment
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require __DIR__ . '/../config/web.php';

(new yii\web\Application($config))->run();
