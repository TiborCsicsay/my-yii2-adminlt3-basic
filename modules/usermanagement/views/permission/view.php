<?php
/**
 * @var $this yii\web\View
 * @var yii\widgets\ActiveForm $form
 * @var array $routes
 * @var array $childRoutes
 * @var array $permissionsByGroup
 * @var array $childPermissions
 * @var yii\rbac\Permission $item
 */

use webvimark\modules\UserManagement\components\GhostHtml;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$this->title = Yii::t('back', 'Settings for permission') . ': ' . $item->description;
$this->params['breadcrumbs'][] = ['label' => Yii::t('back', 'Permissions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success text-center">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>

    <div class="row">
        <div class="col-sm-6">
            <?= Html::beginForm(['set-child-permissions', 'id' => $item->name]) ?>
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-table mr-2"></i> <?= Yii::t('back', 'Child permissions') ?>
                    </h3>
                </div>
                <div class="card-body small-text small-line-height">
                    <div class="row">
                        <?php foreach ($permissionsByGroup as $groupName => $permissions): ?>
                            <div class="col-sm-6">
                                <div class="card card-default mb-0">
                                    <div class="card-header">
                                        <h3 class="card-title"><?= $groupName ?></h3>
                                    </div>
                                    <div class="card-body">
                                        <?php foreach ($permissions as $permission): ?>
                                            <div class="d-block">
                                                <label>
                                                    <?php $isChecked = in_array($permission->name, ArrayHelper::map($childPermissions, 'name', 'name')) ? 'checked' : '' ?>
                                                    <input type="checkbox" <?= $isChecked ?> name="child_permissions[]"
                                                           value="<?= $permission->name ?>">
                                                    <?= $permission->description ?>
                                                </label>

                                                <?= GhostHtml::a(
                                                    '<i class="fa fa-edit"></i>',
                                                    ['view', 'id' => $permission->name],
                                                    ['target' => '_blank']
                                                ) ?>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <div class="card-footer bg-light border-top">
                    <?= Html::submitButton(
                        '<i class="fas fa-check"></i>  ' . Yii::t('back', 'Save'),
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
            <?= Html::endForm() ?>
        </div>

        <div class="col-sm-6">
            <?= Html::beginForm(['set-child-routes', 'id' => $item->name]) ?>
            <div class="card panel-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-road"></i> <?= Yii::t('back', 'Routes') ?>
                    </h3>
                    <div class="card-tools">
                        <?= Html::a(
                            Yii::t('back', 'Refresh routes (and delete unused)'),
                            ['refresh-routes', 'id' => $item->name, 'deleteUnused' => 1],
                            [
                                'class' => 'btn btn-default btn-xs pull-right',
                                'style' => 'margin-top:-5px; text-transform:none;',
                                'data-confirm' => Yii::t('back', 'Routes that are not exists in this application will be deleted. Do not recommended for application with "advanced" structure, because frontend and backend have they own set of routes.'),
                            ]
                        ) ?>

                        <?= Html::a(
                            Yii::t('back', 'Refresh routes'),
                            ['refresh-routes', 'id' => $item->name],
                            [
                                'class' => 'btn btn-default btn-xs pull-right',
                                'style' => 'margin-top:-5px; text-transform:none;',
                            ]
                        ) ?>
                    </div>
                </div>
                <div class="card-body small-text small-line-height pt-0"
                     style="max-height: calc( 100vh - 400px );overflow-y: scroll;">
                    <div class="row position-sticky sticky-top bg-white p-3 border-bottom">
                        <div class="col-sm-2">
                            <?= Html::submitButton(
                                '<i class="fas fa-check"></i>  ' . Yii::t('back', 'Save'),
                                ['class' => 'btn btn-primary']
                            ) ?>
                        </div>
                        <div class="col">
                            <input id="search-in-routes" autofocus="on" type="text" class="form-control input-xs"
                                   placeholder="<?= Yii::t('back', 'Search route'); ?>">
                        </div>
                        <div class="col-sm-4 btn-group">
                            <button type="button" id="show-only-selected-routes" class="btn btn-default btn-xs">
                                <i class="fa fa-minus mr-1"></i> <?= Yii::t('back', 'Show only selected'); ?>
                            </button>
                            <button type="button" id="show-all-routes" class="btn btn-default btn-xs hide">
                                <i class="fa fa-plus mr-1"></i> <?= Yii::t('back', 'Show all'); ?>
                            </button>
                        </div>
                    </div>


                    <?= Html::checkboxList(
                        'child_routes',
                        ArrayHelper::map($childRoutes, 'name', 'name'),
                        ArrayHelper::map($routes, 'name', 'name'),
                        [
                            'id' => 'routes-list',
                            'class' => 'mt-3',
                            'separator' => '<div class="separator"></div>',
                            'item' => function ($index, $label, $name, $checked, $value) {
                                return Html::checkbox($name, $checked, [
                                    'value' => $value,
                                    'label' => '<span class="route-text">' . $label . '</span>',
                                    'labelOptions' => ['class' => 'route-label'],
                                    'class' => 'route-checkbox',
                                ]);
                            },
                        ]
                    ) ?>
                </div>
                <div class="card-footer bg-light border-top">
                    <?= Html::submitButton(
                        '<i class="fas fa-check"></i>  ' . Yii::t('back', 'Save'),
                        ['class' => 'btn btn-primary']
                    ) ?>
                </div>
            </div>
            <?= Html::endForm() ?>
        </div>
    </div>

<?php
$js = <<<JS

var routeCheckboxes = $('.route-checkbox');
var routeText = $('.route-text');

// For checked routes
var backgroundColor = '#D6FFDE';

function showAllRoutesBack() {
	$('#routes-list').find('.route-label').each(function(){
		$(this).show();
	});
}

//Make tree-like structure by padding controllers and actions
routeText.each(function(){
	var _t = $(this);

	var chunks = _t.html().split('/').reverse();
	var margin = chunks.length * 40 - 40;

	if ( chunks[0] == '*' )
	{
		margin -= 40;
	}

	_t.closest('label').css('margin-left', margin);

});

// Highlight selected checkboxes
routeCheckboxes.each(function(){
	var _t = $(this);

	if ( _t.is(':checked') )
	{
		_t.closest('label').css('background', backgroundColor);
	}
});

// Change background on check/uncheck
routeCheckboxes.on('change', function(){
	var _t = $(this);

	if ( _t.is(':checked') )
	{
		_t.closest('label').css('background', backgroundColor);
	}
	else
	{
		_t.closest('label').css('background', 'none');
	}
});


// Hide on not selected routes
$('#show-only-selected-routes').on('click', function(){
	$(this).addClass('hide');
	$('#show-all-routes').removeClass('hide');

	routeCheckboxes.each(function(){
		var _t = $(this);

		if ( ! _t.is(':checked') )
		{
			_t.closest('label').hide();
			_t.closest('div.separator').hide();
		}
	});
});

// Show all routes back
$('#show-all-routes').on('click', function(){
	$(this).addClass('hide');
	$('#show-only-selected-routes').removeClass('hide');

	showAllRoutesBack();
});

// Search in routes and hide not matched
$('#search-in-routes').on('change keyup', function(){
	var input = $(this);

	if ( input.val() == '' )
	{
		showAllRoutesBack();
		return;
	}

	routeText.each(function(){
		var _t = $(this);

		if ( _t.html().indexOf(input.val()) > -1 )
		{
			_t.closest('label').show();
			_t.closest('div.separator').show();
		}
		else
		{
			_t.closest('label').hide();
			_t.closest('div.separator').hide();
		}
	});
});

JS;

$this->registerJs($js);
?>