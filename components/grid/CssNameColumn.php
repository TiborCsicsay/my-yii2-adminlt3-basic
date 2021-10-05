<?php

namespace app\components\grid;

use yii\helpers\Html;

class CssNameColumn extends \yii\grid\DataColumn
{

    /**
     * @var
     */
    public $childattribute;

    /**
     * @var
     */
    public $hrefurl;

    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content === null) {
            if ($this->childattribute)
            {
                //dump($model[$this->childattribute]->movie_name);
                return Html::a($model[$this->childattribute]->name,['view?&id='.$model[$this->childattribute]->id]);
            }
            return Html::a($model->name,['view?&id='.$model->id]);
        }
        return parent::renderDataCellContent($model, $key, $index);
    }
}