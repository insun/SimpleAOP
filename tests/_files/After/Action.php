<?php

namespace sample\After;

use SimpleAOP\Advice\After\Action as AfterAdvice;

class Action extends AfterAdvice
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