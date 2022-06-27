<?php
namespace app\modules\usermanagement\components;

use yii\base\Event;

class AbstractItemEvent extends Event
{
    public $parentName;
    public $childrenNames;
    public $throwException = false;
}
