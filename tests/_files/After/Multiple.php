<?php

namespace sample\After;

use AopJoinpoint;
use SimpleAOP\Advice\After as AfterAdvice;

class Multiple extends AfterAdvice
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
            'sample\Business::foo()',
            'sample\Business::bar()'
        );
    }
}