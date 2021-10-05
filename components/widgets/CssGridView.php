<?php

/**
 * @package   yii2-grid
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014 - 2021
 * @version   3.3.6
 */

namespace app\components\widgets;

use Closure;
use Exception;
use kartik\grid\GridView;
use Yii;
use yii\base\InvalidConfigException;
use yii\bootstrap4\Modal;
use yii\grid\Column;
use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * The GridView widget is used to display data in a grid. It provides features like [[sorter|sorting]], [[pager|paging]]
 * and also [[filterModel|filtering]] the data.  The [[GridView]] widget extends and modifies [[YiiGridView]] with
 * various new enhancements.
 *
 * The columns of the grid are configured in terms of [[Column]] classes, which are configured via [[columns]]. The look
 * and feel of a grid view can be customized using the large amount of properties.
 *
 * The GridView is available and configurable as part of the Krajee grid [[Module]] with various new additional grid
 * columns and enhanced settings. The extension also incorporates various Bootstrap 3.x styling options, inbuilt
 * additional jQuery plugins and has embedded support for Pjax based rendering.
 *
 * A basic usage of the widget looks like the following:
 *
 * ~~~
 * <?= GridView::widget([
 *     'dataProvider' => $dataProvider,
 *     'columns' => [
 *         'id',
 *         'name',
 *         'created_at:datetime',
 *         // ...
 *     ]
 * ]) ?>
 * ~~~
 *
 * @see http://demos.krajee.com/grid
 * @author Kartik Visweswaran <kartikv2@gmail.com>
 * @since  1.0
 */
class CssGridView extends GridView
{
    public $modal;

    /**
     * @inheritdoc
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function run()
    {
        Pjax::begin(['id' => 'pjax_form']);
        $csrf = Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken);
        echo Html::tag('form',$csrf,['id'=>'testForm','method'=>'GET', 'action' => 'index', 'data-pjax' => true]);
        Pjax::end();
        parent::run();
    }

    /**
     * Initialize the grid layout.
     * @throws InvalidConfigException
     */
    protected function initLayout()
    {
        Html::addCssClass($this->filterRowOptions, 'skip-export');
        if ($this->resizableColumns && $this->persistResize) {
            $key = empty($this->resizeStorageKey) ? Yii::$app->user->id : $this->resizeStorageKey;
            $gridId = empty($this->options['id']) ? $this->getId() : $this->options['id'];
            $this->containerOptions['data-resizable-columns-id'] = (empty($key) ? "kv-{$gridId}" : "kv-{$key}-{$gridId}");
        }
        if ($this->hideResizeMobile) {
            Html::addCssClass($this->options, 'hide-resize');
        }
        $this->replaceLayoutTokens([
            '{modal}' => $this->renderModalContent(),
            '{toolbarContainer}' => $this->renderToolbarContainer(),
            '{toolbar}' => $this->renderToolbar(),
            '{export}' => $this->renderExport(),
            '{toggleData}' => $this->renderToggleData(),
            '{items}' => Html::tag('div', '{items}', $this->containerOptions),
        ]);
        if (is_array($this->replaceTags) && !empty($this->replaceTags)) {
            foreach ($this->replaceTags as $key => $value) {
                if ($value instanceof Closure) {
                    $value = call_user_func($value, $this);
                }
                $this->layout = str_replace($key, $value, $this->layout);
            }
        }
    }

    protected function renderModalContent()
    {
        if($this->modal)
        {
            Modal::begin($this->modal['options']);
            echo Html::tag('div','',['class' => 'row modalContent']);
            echo $this->modal['content'];
            Modal::end();
        }
    }

    /**
     * Renders a table row with the given data model and key.
     * @param mixed $model the data model to be rendered
     * @param mixed $key the key associated with the data model
     * @param int $index the zero-based index of the data model among the model array returned by [[dataProvider]].
     * @return string the rendering result
     */
    public function renderTableRow($model, $key, $index)
    {
        $cells = [];
        /* @var $column Column */
        foreach ($this->columns as $column) {
            $column->contentOptions['class'] = 'kv-align-left kv-align-middle';
            $cells[] = $column->renderDataCell($model, $key, $index);
        }
        if ($this->rowOptions instanceof Closure) {
            $options = call_user_func($this->rowOptions, $model, $key, $index, $this);
        } else {
            $options = $this->rowOptions;
        }
        $options['data-key'] = static::parseKey($key);
        Html::addCssClass($options, $this->options['id']);
        return Html::tag('tr', implode('', $cells), $options);
    }

    /**
     * @var array the panel settings for displaying the grid view within a bootstrap styled panel. This property is
     * therefore applicable only if [[bootstrap]] property is `true`. The following array keys can be configured:
     * - `type`: _string_, the panel contextual type. Set it to one of the TYPE constants. If not set, will default to
     *   [[TYPE_DEFAULT]].
     * - `options`: _array_, the HTML attributes for the panel container. If the `class` is not set, it will be auto
     *   derived using the panel `type` and [[panelPrefix]]
     * - `heading`: `string`|`boolean`, the panel heading. If set to `false`, will not be displayed.
     * - `headingOptions`: _array_, HTML attributes for the panel heading container. Defaults to:
     *   - `['class'=>'panel-heading']` when [[bsVersion]] = `3.x`, and
     *   - `['class'=>'card-heading <COLOR>']` when [[bsVersion]] = `4.x` - the color will be auto calculated based on
     *      the `type` setting
     * - `titleOptions`: _array_, HTML attributes for the panel title container. The following tags are specially
     *   parsed:
     *   - `tag`: _string_, the HTML tag to render the title. Defaults to `h3` when [[bsVersion]] = `3.x` and `span`
     *     when [[bsVersion]] = `4.x`
     *   The `titleOptions` defaults to:
     *   - `['class'=>'panel-title']` when [[bsVersion]] = `3.x`, and
     *   - `[]` when [[bsVersion]] = `4.x`
     * - `summaryOptions`: _array_, HTML attributes for the panel summary section container. Defaults to:
     *   - `['class'=>'pull-right']` when [[bsVersion]] = `3.x`, and
     *   - `['class'=>'float-right']` when [[bsVersion]] = `4.x`, and
     * - `footer`: `string`|`boolean`, the panel footer. If set to `false` will not be displayed.
     * - `footerOptions`: _array_, HTML attributes for the panel footer container. Defaults to:
     *   - `['class'=>'panel-footer']` when [[bsVersion]] = `3.x`, and
     *   - `['class'=>'card-footer']` when [[bsVersion]] = `4.x`
     * - 'before': `string`|`boolean`, content to be placed before/above the grid (after the header). To not display
     *   this section, set this to `false`.
     * - `beforeOptions`: _array_, HTML attributes for the `before` text. If the `class` is not set, it will default to
     *   `kv-panel-before`.
     * - 'after': `string`|`boolean`, any content to be placed after/below the grid (before the footer). To not
     *   display this section, set this to `false`.
     * - `afterOptions`: _array_, HTML attributes for the `after` text. If the `class` is not set, it will default to
     *   `kv-panel-after`.
     */
    public $panel = ['heading' => 'Tábla címe'];

    /**
     * @var string the template for rendering the grid within a bootstrap styled panel.
     * The following special tokens are recognized and will be replaced:
     * - `{prefix}`: _string_, the CSS prefix name as set in [[panelPrefix]]. Defaults to `panel panel-`.
     * - `{type}`: _string_, the panel type that will append the bootstrap contextual CSS.
     * - `{panelHeading}`: _string_, which will render the panel heading block.
     * - `{panelBefore}`: _string_, which will render the panel before block.
     * - `{panelAfter}`: _string_, which will render the panel after block.
     * - `{panelFooter}`: _string_, which will render the panel footer block.
     * - `{items}`: _string_, which will render the grid items.
     * - `{summary}`: _string_, which will render the grid results summary.
     * - `{pager}`: _string_, which will render the grid pagination links.
     * - `{toolbar}`: _string_, which will render the [[toolbar]] property passed
     * - `{toolbarContainer}`: _string_, which will render the toolbar container. See [[renderToolbarContainer()]].
     * - `{export}`: _string_, which will render the [[export]] menu button content.
     */
    public $panelTemplate = <<< HTML
{modal}
{panelHeading}
<!--{panelBefore}-->
{items}
<!--{panelAfter}-->
{panelFooter}
HTML;

    /**
     * @var string the template for rendering the panel heading. The following special tokens are
     * recognized and will be replaced:
     * - `{title}`: _string_, which will render the panel heading title content.
     * - `{summary}`: _string_, which will render the grid results summary.
     * - `{items}`: _string_, which will render the grid items.
     * - `{pager}`: _string_, which will render the grid pagination links.
     * - `{sort}`: _string_, which will render the grid sort links.
     * - `{toolbar}`: _string_, which will render the [[toolbar]] property passed
     * - `{toolbarContainer}`: _string_, which will render the toolbar container. See [[renderToolbarContainer()]].
     * - `{export}`: _string_, which will render the [[export]] menu button content.
     */
    public $panelHeadingTemplate = <<< HTML
    <div class='row'>
        <div class='col-sm-6 d-flex justify-content-start p-2'>
            <h3 class="card-title">{title}</h3>
        </div>
        <div class='col-sm-6 d-flex justify-content-end'>
            {toolbarContainer}
        </div>
    </div>
    <div class="clearfix"></div>
HTML;

    /**
     * @var string the template for rendering the panel footer. The following special tokens are
     * recognized and will be replaced:
     * - `{title}`: _string_, which will render the panel heading title content.
     * - `{footer}`: _string_, which will render the panel footer content.
     * - `{summary}`: _string_, which will render the grid results summary.
     * - `{items}`: _string_, which will render the grid items.
     * - `{sort}`: _string_, which will render the grid sort links.
     * - `{pager}`: _string_, which will render the grid pagination links.
     * - `{toolbar}`: _string_, which will render the [[toolbar]] property passed
     * - `{export}`: _string_, which will render the [[export]] menu button content
     */
    public $panelFooterTemplate = <<< HTML
    <div class='row'>
        <div class='col-sm-6 d-flex justify-content-start p-2'>
            {summary}
        </div>
        <div class='col-sm-6 d-flex justify-content-end'>
            {pager}
        </div>
    </div>
<!--    {footer}-->
<!--    <div class="clearfix"></div>-->
HTML;

    /**
     * @var string the template for rendering the `{before} part in the layout templates.
     * The following special tokens are recognized and will be replaced:
     * - `{before}`: _string_, which will render the [[before]] text passed in the panel settings
     * - `{summary}`: _string_, which will render the grid results summary.
     * - `{items}`: _string_, which will render the grid items.
     * - `{sort}`: _string_, which will render the grid sort links.
     * - `{pager}`: _string_, which will render the grid pagination links.
     * - `{toolbar}`: _string_, which will render the [[toolbar]] property passed
     * - `{toolbarContainer}`: _string_, which will render the toolbar container. See [[renderToolbarContainer()]].
     * - `{export}`: _string_, which will render the [[export]] menu button content
     */
    public $panelBeforeTemplate = <<< HTML
    {toolbarContainer}
    {before}
    <div class="clearfix"></div>
HTML;

}