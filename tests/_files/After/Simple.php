<?php

namespace sample\After;

use SimpleAOP\Aspect\After\Simple as AfterAspect;

class Simple extends AfterAspect
{
    /**
     * After advice for custom method
     * @param mixed $return
     */
    public function afterCustom($return)
    {
        return "customisation in progress";
    }
    
    /**
     * After advice
     * @param mixed $return
     */
    public function after($return)
    {
        return  $return . " is overrided";
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Business::*()';
    }
}