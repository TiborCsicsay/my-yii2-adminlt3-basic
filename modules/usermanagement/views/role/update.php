<?php
/**
 * @var yii\widgets\ActiveForm $form
 * @var app\modules\usermanagement\models\rbacDB\Role $model
 */

use app\modules\usermanagement\UserManagementModule;

$this->title = UserManagementModule::t('back', 'Editing role: ') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<h2 class="lte-hide-title"><?= $this->title ?></h2>

<div class="card card-default">
	<div class="card-body">
		<?= $this->render('_form', [
			'model'=>$model,
		]) ?>
	</div>
</div>