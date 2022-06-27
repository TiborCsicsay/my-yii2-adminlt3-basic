<?php
/**
 * @author Lajos Molnár <lajax.m@gmail.com>
 *
 * @since 1.0
 */
use yii\grid\GridView;
use yii\helpers\Html;
use app\modules\translatemanager\models\Language;
use yii\widgets\Pjax;

/* @var $this \yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel app\modules\translatemanager\models\searches\LanguageSearch */

$this->title = Yii::t('language', 'List of languages'). ' - GOPALL admin';
$this->params['breadcrumbs'][] = $this->title;

?>
<div id="languages">

    <div class="btn-group my-2">
        <a class="btn btn-primary" href="/translatemanager/language/scan" role="button">Scan</i></a>
        <a class="btn btn-primary" href="/translatemanager/language/import" role="button">Import</i></a>
        <a class="btn btn-primary" href="/translatemanager/language/export" role="button">Export</i></a>
    </div>


    <?php
    Pjax::begin([
        'id' => 'languages',
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'language_id',
            'name_ascii',
            [
                'format' => 'raw',
                'filter' => Language::getStatusNames(),
                'attribute' => 'status',
                'filterInputOptions' => ['class' => 'form-control', 'id' => 'status'],
                'label' => Yii::t('language', 'Status'),
                'content' => function ($language) {
                    return Html::activeDropDownList($language, 'status', Language::getStatusNames(), ['class' => 'status', 'id' => $language->language_id, 'data-url' => Yii::$app->urlManager->createUrl('/translatemanager/language/change-status')]);
                },
            ],
            [
                'format' => 'raw',
                'attribute' => Yii::t('language', 'Statistic'),
                'content' => function ($language) {
                    return '<span class="statistic"><span style="width:' . $language->gridStatistic . '%"></span><i>' . $language->gridStatistic . '%</i></span>';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {translate} {delete}',
                'buttons' => [
                    'translate' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>', ['language/translate', 'language_id' => $model->language_id], [
                            'title' => Yii::t('language', 'Translate'),
                            'data-pjax' => '0',
                        ]);
                    },
                ],
            ],
        ],
    ]);
    Pjax::end();
    ?>
</div>