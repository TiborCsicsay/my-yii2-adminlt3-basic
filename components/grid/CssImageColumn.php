<?php

namespace app\components\grid;

use Yii;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\imagine\Image;

class CssImageColumn extends DataColumn
{
    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        if ($this->content === null) {
            //dump(Yii::getAlias('@web').'/images/img1.jpg');
            //dump(Yii::getAlias('@web/images/img1.jpg'));
            //exit;
            return Html::img(Yii::getAlias('@web/images/'.$model->imgurl),['class' => 'img', 'style' => 'width:80px']);
            //return Image::thumbnail('@webroot/images/img1.jpg', 30, 30)->save(Yii::getAlias('@webroot/images/img1.jpg'), ['quality' => 50]);;
        }

        return parent::renderDataCellContent($model, $key, $index);
    }
}