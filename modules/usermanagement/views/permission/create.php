<?php
/**
 *
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\modules\usermanagement\models\rbacDB\Permission $model
 */

use app\modules\usermanagement\UserManagementModule;

$this->title = UserManagementModule::t('back', 'Permission creation');
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Permissions'), 'url' => ['index']];
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