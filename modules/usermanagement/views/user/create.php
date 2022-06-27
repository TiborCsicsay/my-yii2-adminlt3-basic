<?php

use app\modules\usermanagement\UserManagementModule;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\modules\usermanagement\models\User $model
 */

$this->title = UserManagementModule::t('back', 'User creation');
$this->params['breadcrumbs'][] = ['label' => UserManagementModule::t('back', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

	<h2 class="lte-hide-title"><?= $this->title ?></h2>

	<div class="card card-default">
		<div class="card-body">

			<?= $this->render('_form', compact('model')) ?>
		</div>
	</div>

</div>
