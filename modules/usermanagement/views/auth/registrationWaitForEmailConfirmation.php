<?php

use app\modules\usermanagement\UserManagementModule;

/**
 * @var yii\web\View $this
 * @var app\modules\usermanagement\models\User $user
 */

$this->title = UserManagementModule::t('front', 'Registration - confirm your e-mail');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registration-wait-for-confirmation">

	<div class="alert alert-info text-center">
		<?= UserManagementModule::t('front', 'Check your e-mail {email} for instructions to activate account', [
			'email'=>'<b>'. $user->email .'</b>'
		]) ?>
	</div>

</div>
