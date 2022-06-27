<?php

return \yii\helpers\ArrayHelper::merge(
    require __DIR__ . '/_base.php',
    [
        // 'db' output format is for saving messages to database.
        'format' => 'db',
        // Connection component to use. Optional.
        'db' => 'db',
        'sourceMessageTable' => '{{%language_source}}',
        'messageTable' => '{{%language_translate}}',
    ]
);