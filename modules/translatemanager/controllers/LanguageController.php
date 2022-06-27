<?php

namespace app\modules\translatemanager\controllers;

use app\services\LanguageService;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use app\modules\translatemanager\models\Language;

/**
 * Controller for managing multilinguality.
 *
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */
class LanguageController extends Controller
{
    public $layout = '@app/modules/admin/views/layouts/main';

    /**
     * @var \app\modules\translatemanager\Module TranslateManager module
     */
    public $module;

    /**
     * @inheritdoc
     */
    public $defaultAction = 'list';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['list', 'change-status', 'optimizer', 'scan', 'translate', 'save', 'dialog', 'message', 'view', 'create', 'update', 'delete', 'delete-source', 'import', 'export'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list', 'change-status', 'optimizer', 'scan', 'translate', 'save', 'dialog', 'message', 'view', 'create', 'update', 'delete', 'delete-source', 'import', 'export'],
                        'roles' => $this->module->roles,
                    ],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'list' => [
                'class' => 'app\modules\translatemanager\controllers\actions\ListAction',
            ],
            'change-status' => [
                'class' => 'app\modules\translatemanager\controllers\actions\ChangeStatusAction',
            ],
            'optimizer' => [
                'class' => 'app\modules\translatemanager\controllers\actions\OptimizerAction',
            ],
            'scan' => [
                'class' => 'app\modules\translatemanager\controllers\actions\ScanAction',
            ],
            'translate' => [
                'class' => 'app\modules\translatemanager\controllers\actions\TranslateAction',
            ],
            'save' => [
                'class' => 'app\modules\translatemanager\controllers\actions\SaveAction',
            ],
            'dialog' => [
                'class' => 'app\modules\translatemanager\controllers\actions\DialogAction',
            ],
            'message' => [
                'class' => 'app\modules\translatemanager\controllers\actions\MessageAction',
            ],
            'view' => [
                'class' => 'app\modules\translatemanager\controllers\actions\ViewAction',
            ],
            'create' => [
                'class' => 'app\modules\translatemanager\controllers\actions\CreateAction',
            ],
            'update' => [
                'class' => 'app\modules\translatemanager\controllers\actions\UpdateAction',
            ],
            'delete' => [
                'class' => 'app\modules\translatemanager\controllers\actions\DeleteAction',
            ],
            'delete-source' => [
                'class' => 'app\modules\translatemanager\controllers\actions\DeleteSourceAction',
            ],
            'import' => [
                'class' => 'app\modules\translatemanager\controllers\actions\ImportAction',
            ],
            'export' => [
                'class' => 'app\modules\translatemanager\controllers\actions\ExportAction',
            ],
        ];
    }

    public function actionChangeLanguage()
    {
        $language = \Yii::$app->request->post(LanguageService::LANGUAGE);

        /** @var LanguageService $languageService */
        $languageService = \Yii::$app->languageService;
        $languageService->setLanguage($language);

        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param string $id
     *
     * @return Language the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if (($model = Language::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Returns an ArrayDataProvider consisting of language elements.
     *
     * @param array $languageSources
     *
     * @return ArrayDataProvider
     */
    public function createLanguageSourceDataProvider($languageSources)
    {
        $data = [];
        foreach ($languageSources as $category => $messages) {
            foreach ($messages as $message => $boolean) {
                $data[] = [
                    'category' => $category,
                    'message' => $message,
                ];
            }
        }

        return new ArrayDataProvider([
            'allModels' => $data,
            'pagination' => false,
        ]);
    }
}
