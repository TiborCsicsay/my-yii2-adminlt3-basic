<?php

namespace app\modules\usermanagement\components;

use yii\web\User;
use Yii;

/**
 * Class UserConfig
 * @package app\modules\usermanagement\components
 */
class UserConfig extends User
{
	/**
	 * @inheritdoc
	 */
	public $identityClass = 'app\modules\usermanagement\models\User';

	/**
	 * @inheritdoc
	 */
	public $enableAutoLogin = true;
	
	/**
 	 * @inheritdoc
	 */
	public $cookieLifetime = 2592000;
  
	/**
	 * @inheritdoc
	 */
	public $loginUrl = ['/user-management/auth/login'];

	/**
	 * Allows to call Yii::$app->user->isSuperadmin
	 *
	 * @return bool
	 */
	public function getIsSuperadmin()
	{
		return @Yii::$app->user->identity->superadmin == 1;
	}

	/**
	 * @return string
	 */
	public function getUsername()
	{
		return @Yii::$app->user->identity->username;
	}

	/**
	 * @inheritdoc
	 */
	protected function afterLogin($identity, $cookieBased, $duration)
	{
		AuthHelper::updatePermissions($identity);

		parent::afterLogin($identity, $cookieBased, $duration);
	}

}