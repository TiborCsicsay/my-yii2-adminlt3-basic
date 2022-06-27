<?php

/**
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\modules\translatemanager\helpers\Language;
use app\modules\translatemanager\models\Language as Lang;

/* @var $this \yii\web\View */
/* @var $language_id string */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\translatemanager\models\searches\LanguageSourceSearch */
/* @var $searchEmptyCommand string */

$language_id = $searchModel->source;

$this->title = Yii::t('language', 'Translation into {language_id}', ['language_id' => $language_id]) . ' - GOPALL admin';
$this->params['breadcrumbs'][] = ['label' => Yii::t('language', 'Languages'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?= Html::hiddenInput('language_id', $language_id, ['id' => 'language_id', 'data-url' => Yii::$app->urlManager->createUrl('/translatemanager/language/save')]); ?>
<div id="translates" class="<?= $language_id ?>">
    <div class="btn-group my-2">
        <a class="btn btn-primary" href="/translatemanager/language/scan" role="button">Scan</i></a>
        <a class="btn btn-primary" href="/translatemanager/language/import" role="button">Import</i></a>
        <a class="btn btn-primary" href="/translatemanager/language/export" role="button">Export</i></a>
    </div>
    <?php
    Pjax::begin([
        'id' => 'translates',
    ]);
    $form = ActiveForm::begin([
        'method' => 'get',
        'id' => 'search-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => false,
    ]);
    echo $form->field($searchModel, 'source')->dropDownList(['' => Yii::t('language', 'Select Language')] + Lang::getLanguageNames(true))->label(Yii::t('language', 'Source language'));
    ActiveForm::end();

    echo '<p class="text-danger mb-3 no-language-selected" data-message="' . \Yii::t('back', 'No language selected') . '"></p>';
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'format' => 'raw',
                'filter' => Language::getCategories(),
                'attribute' => 'category',
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'category'],
            ],
            [
                'format' => 'raw',
                'attribute' => 'message',
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'message'],
                'label' => Yii::t('language', 'Source'),
                'content' => function ($data) {
                    return Html::textarea('LanguageSource[' . $data->id . ']', $data->source, ['class' => 'form-control source', 'readonly' => 'readonly']);
                },
            ],
            [
                'format' => 'raw',
                'attribute' => 'translation',
                'filterInputOptions' => [
                    'class' => 'form-control',
                    'id' => 'translation',
                    'placeholder' => $searchEmptyCommand ? Yii::t('language', 'Enter "{command}" to search for empty translations.', ['command' => $searchEmptyCommand]) : '',
                ],
                'label' => Yii::t('language', 'Translation'),
                'content' => function ($data) {
                    $language_id = ArrayHelper::getValue(Yii::$app->request->get(), 'LanguageSourceSearch.source', \Yii::$app->sourceLanguage);
                    $translation = \app\modules\translatemanager\models\LanguageTranslate::findOne(['id' => $data->id, 'language' => $language_id]);
//                    return Html::textarea('LanguageTranslate[' . $data->id . ']', $data->translation, ['class' => 'form-control translation', 'data-id' => $data->id, 'tabindex' => $data->id]);
                    return Html::textarea('LanguageTranslate[' . $data->id . ']', $translation ? $translation->translation : '', ['class' => 'form-control translation', 'data-id' => $data->id, 'tabindex' => $data->id]);
                },
            ],
            [
                'format' => 'raw',
                'label' => Yii::t('language', 'Action'),
                'content' => function ($data) {
                    return Html::button(Yii::t('language', 'Save'), ['type' => 'button', 'data-id' => $data->id, 'class' => 'btn btn-lg btn-success']);
                },
            ],
        ],
    ]);
    Pjax::end();
    ?>

</div>

<?php \richardfan\widget\JSRegister::begin() ?>
<script>
    const languageSelect = document.querySelector('#languagesourcesearch-source');
    handleErrorMessage();

    function handleErrorMessage() {
        const errorMessage = document.querySelector('.no-language-selected');

        if(!languageSelect.value) {
            errorMessage.textContent = errorMessage.dataset.message;
        } else {
            errorMessage.textContent = '';
        }
    }
</script>
<?php \richardfan\widget\JSRegister::end() ?>