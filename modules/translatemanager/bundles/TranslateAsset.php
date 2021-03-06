<?php

namespace app\modules\translatemanager\bundles;

use yii\web\AssetBundle;

/**
 * Contains css files necessary for modify translations on the backend.
 *
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */
class TranslateAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@app/modules/translatemanager/assets';

    /**
     * @inheritdoc
     */
    public $css = [
        'stylesheets/helpers.css',
        'stylesheets/translate.css',
    ];
}
