<?php

namespace sample\After;

use SimpleAOP\Aspect\After\Action as AfterAspect;

class Action extends AfterAspect
{
    /**
     * After advice in controller
     * @param null|ModelInterface $model
     */
    public function afterCustomAction($model)
    {
        return "customisation in progress";
    }

    /**
     * After advice in controller
     * @param null|ModelInterface $model
     */
    public function after($model)
    {
        return $model['attr'] . " is overrided";
    }

    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Business::*Action()';
    }
}
