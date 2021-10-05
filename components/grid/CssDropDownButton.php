<?php

namespace app\components\grid;

use Yii;
use yii\helpers\Html;

class CssDropDownButton
{

    public function dropdownButton($form ,$buttonNames = [],$options = [])
    {
        $buttons = '';
        foreach ($buttonNames as $button)
        {
            $buttons.= Html::button($button,[]);
        }
        $content = Html::button(
            'Actions'.Html::tag('span','ToggleDropdown',['class' => 'sr-only']),
            ['class' => 'btn-group', 'data-toggle'=>'dropdown']
        );
        $content = Html::tag('div',$content,['class' => 'btn-group']);

        return $content;
    }
}