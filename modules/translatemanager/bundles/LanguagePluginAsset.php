<?php

namespace app\modules\translatemanager\bundles;

use yii\web\AssetBundle;

/**
 * Contains javascript files necessary for language list on the backend.
 *
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */
class LanguagePluginAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@app/modules/translatemanager/assets';

    /**
     * @inheritdoc
     */
    public $js = [
        'javascripts/helpers.js',
        'javascripts/language.js',
    ];

//    public $publishOptions = [
//        'forceCopy' => true,
//    ];


    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
