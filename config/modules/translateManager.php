<?php

return [
    'class' => 'app\modules\translatemanager\Module',
    'controllerMap' => [
        'language' => 'app\modules\translatemanager\controllers\LanguageController'
    ],
    'root' => '@app',               // The root directory of the project scan.
    'scanRootParentDirectory' => true, // Whether scan the defined `root` parent directory, or the folder itself.
    // IMPORTANT: for detailed instructions read the chapter about root configuration.
    'layout' => 'language',         // Name of the used layout. If using own layout use 'null'.
    'allowedIPs' => ['*'],  // IP addresses from which the translation interface is accessible.
    'roles' => ['@'],               // For setting access levels to the translating interface.
    'tmpDir' => '@runtime',         // Writable directory for the client-side temporary language files.
    // IMPORTANT: must be identical for all applications (the AssetsManager serves the JavaScript files containing language elements from this directory).
    'phpTranslators' => ['::t'],    // list of the php function for translating messages.
    'jsTranslators' => ['lajax.t'], // list of the js function for translating messages.
    //'patterns' => ['*.js', '*.php'],// list of file extensions that contain language elements.
    'ignoredCategories' => ['yii', 'app', 'language', 'kvgrid', 'kvdate', 'kvselect', 'kvbase', 'kvdtime', 'fileinput'],
    //'onlyCategories' => ['yii'],    // only these categories will be included in the language database (cannot be used together with "ignoredCategories").
    // 'ignoredItems' => ['config'],   // these files will not be processed.
    'scanTimeLimit' => null,        // increase to prevent "Maximum execution time" errors, if null the default max_execution_time will be used
    'searchEmptyCommand' => '!',    // the search string to enter in the 'Translation' search field to find not yet translated items, set to null to disable this feature
    'defaultExportStatus' => 1,     // the default selection of languages to export, set to 0 to select all languages by default
    'defaultExportFormat' => 'json',// the default format for export, can be 'json' or 'xml'
    'tables' => [                   // Properties of individual tables
        [
            'connection' => 'db',   // connection identifier
            'table' => '{{%language}}',         // table name
            'columns' => ['name', 'name_ascii'],// names of multilingual fields
            'category' => 'database-table-name',// the category is the database table name
        ]
    ],
//    'root' => [
//        '@app/models',
//        '@app/views',
//        '@app/components',
//        '@app/widgets',
//        '@vendor/webvimark/module-user-management'
//    ],
    'scanners' => [ // define this if you need to override default scanners (below)
        '\app\modules\translatemanager\services\scanners\ScannerPhpFunction',
        '\app\modules\translatemanager\services\scanners\ScannerPhpArray',
//        '\app\modules\translatemanager\services\scanners\ScannerJavaScriptFunction',
        '\app\modules\translatemanager\services\scanners\ScannerDatabase',
    ],
];