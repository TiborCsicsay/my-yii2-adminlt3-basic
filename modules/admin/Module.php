<?php

namespace app\modules\admin;

use yii\web\ErrorHandler;

/**
 * mobile module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';
    public $layout = 'main';
    public $defaultRoute = 'default';

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'ghost-access' => [
                'class' => 'app\modules\usermanagement\components\GhostAccessControl',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
    }
}
