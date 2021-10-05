<?php

namespace app\components\grid;

use app\components\grid\CssCheckboxColumnAsset;
use Closure;
use kartik\grid\CheckboxColumn;
use kartik\grid\CheckboxColumnAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Json;

class CssCheckboxColumn extends CheckboxColumn
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }

    /**
     * Renders the header cell content.
     * The default implementation simply renders [[header]].
     * This method may be overridden to customize the rendering of the header cell.
     * @return string the rendering result
     */
    protected function renderHeaderCellContent()
    {
        if ($this->header !== null || !$this->multiple) {
            return parent::renderHeaderCellContent();
        }

        return Html::checkbox($this->getHeaderCheckBoxName(), false, ['class' => 'select-on-check-all', 'label' => 'Select All']);
    }

    /**
     * @inheritdoc
     */
    public function renderDataCell($model, $key, $index)
    {
        $options = $this->fetchContentOptions($model, $key, $index);
        if ($this->rowHighlight) {
            Html::addCssClass($options, 'kv-row-select');
        }
        $this->initPjax($this->_clientScript);
        if ($this->attribute !== null) {
            $this->name = Html::getInputName($model, "[{$index}]{$this->attribute}");
            if (!$this->checkboxOptions instanceof Closure) {
                $this->checkboxOptions['value'] = Html::getAttributeValue($model, $this->attribute);
            }
        }
        return Html::tag('td', $this->renderDataCellContent($model, $key, $index), $options);
    }

    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content !== null) {
            return parent::renderDataCellContent($model, $key, $index);
        }

        if ($this->checkboxOptions instanceof Closure) {
            $options = call_user_func($this->checkboxOptions, $model, $key, $index, $this);
        } else {
            $options = $this->checkboxOptions;
        }

        if (!isset($options['value'])) {
            $options['value'] = is_array($key) ? Json::encode($key) : $key;
        }

        if ($this->cssClass !== null) {
            Html::addCssClass($options, $this->cssClass);
        }
        $options['form']='testForm';

        return Html::checkbox($this->name, !empty($options['checked']), $options);
    }
}