<?php
return [
    'translations' => [
        '*' => [
            'class' => 'yii\i18n\DbMessageSource',
            'db' => 'db',
            'sourceLanguage' => 'en-US',
            'sourceMessageTable' => '{{%language_source}}',
            'messageTable' => '{{%language_translate}}',
            'forceTranslation' => true,
            'enableCaching' => false,
        ],
//        'user-management' => [
//            'class' => 'yii\i18n\PhpMessageSource',
//            'sourceLanguage' => 'en-US',
//            'basePath' => '@vendor/webvimark/module-user-management/messages',
//        ],
    ],
];