<?php

use app\modules\usermanagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\usermanagement\models\rbacDB\AuthItemGroup $model
 */

$this->title = UserManagementModule::t('back', 'Creating permission group');
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Permission groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-group-create">

	<h2 class="lte-hide-title"><?= $this->title ?></h2>

	<div class="card card-default">
		<div class="card-body">

			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>
