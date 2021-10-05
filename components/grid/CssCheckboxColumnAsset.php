<?php

namespace app\components\grid;

use yii\helpers\Html;
use kartik\base\AssetBundle;

class CssCheckboxColumnAsset extends AssetBundle
{
    /**
     * @inheritdoc
     *
     *      Usage:
     *  in view: CssCheckboxColumnAsset::register($this);
     */
    public function init()
    {
        $this->setSourcePath(__DIR__ . '');
        $this->setupAssets('js', ['assets\js\delete-selected','assets\js\custom-action']);
        parent::init();
    }


    //-------------------------- My functions ------------------------------------


    /**
     * @param $content
     * @param $form
     * @return string
     *      Description:
     * Modal gomb render, delete-selected.js
     *
     *      Example:
     *  CssCheckboxColumnAsset::renderDeleteSelectedButton('Delete Selected'),
     *  add grid in view modal content:
     *
            use yii\grid\GridView;
            use yii\widgets\Pjax;

                Pjax::begin(['id' => 'modal_content']);
                    echo GridView::widget([
                        'dataProvider' => $dataModalProvider,
                        'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        'id',
                        'movie_name',
                    ],
                ]); ?>
            <?php Pjax::end() ?>
     *
     */
    public function renderDeleteSelectedButton($content)
    {
        return Html::button($content,['id' => 'deletSelectedModalButt', 'class' => 'dropdown-item','form' => 'testForm', 'type' => 'submit']);
    }


    /**
     * @param $buttonName
     * @param $id
     * @return string
     *      Description:
     *
     *
     *      Example:
     *  CssCheckboxColumnAsset::renderCostomActionButton('Action1','buttonId','');
     *
     *  <script>
     *      customAction(buttonId,'POST','actionUrl');
     *  </script>
     *
     */
    public function renderCustomActionButton($buttonName, $id)
    {
        return Html::button($buttonName,['class' => 'dropdown-item', 'id' => $id]);
    }


    /**
     * @param $buttonName
     * @param array $buttons
     * @return string
     *      Description:
     *
     *
     *      Example:
     * CssCheckboxColumnAsset::renderDropdownList('Action',
            [
            Html::button(...),
            Html::button(...),
            ]
        )
     *
     *
     */
    public function renderDropdownList($buttonName, $buttons = [])
    {
        $content = '';
        $mainButton = Html::button($buttonName.' '.Html::tag('span','',['class'=>'sr-only']),['class' => "btn btn-outline-secondary dropdown-toggle", 'data-toggle' => "dropdown", 'aria-expanded'=>"false"]);
        foreach ($buttons as $button)
        {
            $content .= $button;
        }
        $dropdownmenu = Html::tag('div',$content,['class'=>"dropdown-menu", 'role'=>"menu"]);
        $dropdown = Html::tag('div',$mainButton.$dropdownmenu,['class' => 'btn-group']);

        return $dropdown;
    }
}