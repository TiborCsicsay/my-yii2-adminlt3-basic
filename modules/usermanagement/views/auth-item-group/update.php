<?php

use app\modules\usermanagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\usermanagement\models\rbacDB\AuthItemGroup $model
 */

$this->title = UserManagementModule::t('back', 'Editing permission group') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Permission groups'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->code]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Editing')
?>
<div class="auth-item-group-update">

	<h2 class="lte-hide-title"><?= $this->title ?></h2>

	<div class="card card-default">
		<div class="card-body">

			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>
