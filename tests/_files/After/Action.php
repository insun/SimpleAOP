<?php

namespace sample\After;

use SimpleAOP\Aspect\After\Action as AfterAspect;

class Action extends AfterAspect
{
    public function afterCustomAction($model)
    {
        $args = implode('', $this->getJoinPoint()->getArguments());
        return "customisation in progress" . $args;
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
