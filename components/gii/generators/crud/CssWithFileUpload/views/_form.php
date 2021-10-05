<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-sm">
        <div class="card">
            <div class="card-body">

                <div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">

                    <?= "<?php " ?>$form = ActiveForm::begin(); ?>

                <?php foreach ($generator->getColumnNames() as $attribute) {
                    if (in_array($attribute, $safeAttributes)) {
                        echo "    <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
                    }
                } ?>
                    <?= "<?= " ?> $form->field($model, 'file')->widget(FileInput::classname()) ?>
                    <div class="card-footer">
                        <div class="form-group">
                            <?= "<?= " ?>Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>
                    <?= "<?php " ?>ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


