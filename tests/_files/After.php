<?php

namespace sample;

use AopJoinpoint;
use SimpleAOP\Aspect\After as AfterAspect;

class After extends AfterAspect
{
    /**
     * After advice for custom method
     * @param AopJoinpoint $jp
     */
    public function afterCustom(AopJoinpoint $jp)
    {
        $jp->setReturnedValue("customisation in progress");
    }
    
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    public function after(AopJoinpoint $jp)
    {
        if($jp->getReturnedValue() === "foo") {
            $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
        }
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