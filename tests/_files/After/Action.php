<?php

namespace sample\After;

use SimpleAOP\Aspect\After\Action as AfterAspect;

class Action extends AfterAspect
{
    public function afterCustomAction($model)
    {
        return "customisation in progress";
    }

    public function after($model)
    {
        return $model['attr'] . " is overrided";
    }

    public function getPointCut()
    {
        return 'sample\Business::*Action()';
    }
}
