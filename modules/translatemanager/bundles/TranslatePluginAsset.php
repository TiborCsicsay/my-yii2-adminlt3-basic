<?php

namespace app\modules\translatemanager\bundles;

use yii\web\AssetBundle;

/**
 * Contains javascript files necessary for modify translations on the backend.
 *
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */
class TranslatePluginAsset extends AssetBundle
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
        'javascripts/translate.js',
    ];

//    public $publishOptions = [
//        'forceCopy' => true,
//    ];


    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'app\modules\translatemanager\bundles\TranslationPluginAsset',
    ];
}
