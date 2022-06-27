<?php

use app\modules\usermanagement\models\User;
use webvimark\extensions\BootstrapSwitch\BootstrapSwitch;
use app\modules\usermanagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\usermanagement\models\User $model
 */

$this->title = UserManagementModule::t('back', 'Editing user: ') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = UserManagementModule::t('back', 'Editing');
?>
<div class="user-update">

	<h2 class="lte-hide-title"><?= $this->title ?></h2>

	<div class="card card-default">
		<div class="card-body">

			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>