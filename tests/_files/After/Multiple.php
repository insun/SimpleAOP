<?php

namespace sample\After;

use AopJoinpoint;
use SimpleAOP\Aspect\After as AfterAspect;

class Multiple extends AfterAspect
{
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    public function after(AopJoinpoint $jp)
    {
        $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return array(
            'sample\Business::mirror()',
            'sample\Business::bar()'
        );
    }
}