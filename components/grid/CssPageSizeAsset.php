<?php

namespace app\components\grid;

use Yii;
use yii\helpers\Html;

class CssPageSizeAsset
{
    /**
     *  Description:
     *
     * A basic usage looks like the following:
     *  '''php
     *      <?= CssPageSizeAssets::pageSize
     *          (
     *              'url',[4,8,16]
     *          )
     *
     * @param $url
     * @param array $pagesizes
     * @return string
     */
    public function pageSize($url, $pagesizes = [])
    {
        $content = '';
        $name = 'Page Size';
        foreach ($pagesizes as $pagesize)
        {
            $content .= Html::a($pagesize,$url.'?pagesize='.$pagesize,['class' => 'dropdown-item']);
        }
        if(Yii::$app->request->get('pagesize'))
        {
            $name = Yii::$app->request->get('pagesize');
        }
        $content = Html::button($name,['class' => 'btn btn-outline-secondary dropdown-toggle', 'data-toggle'=>'dropdown']).Html::tag('div',$content,['class' => 'dropdown-menu','x-placement'=>'bottom-start']);
        $content= Html::tag('div',$content,['class' => 'btn-group']);

        return $content;

    }
}