<?php

namespace app\modules\usermanagement\controllers;

use Yii;
use app\modules\usermanagement\models\UserVisitLog;
use app\modules\usermanagement\models\search\UserVisitLogSearch;
use webvimark\components\AdminDefaultController;

/**
 * UserVisitLogController implements the CRUD actions for UserVisitLog model.
 */
class UserVisitLogController extends AdminDefaultController
{
	/**
	 * @var UserVisitLog
	 */
	public $modelClass = 'app\modules\usermanagement\models\UserVisitLog';

	/**
	 * @var UserVisitLogSearch
	 */
	public $modelSearchClass = 'app\modules\usermanagement\models\search\UserVisitLogSearch';

	public $enableOnlyActions = ['index', 'view', 'grid-page-size'];
}
