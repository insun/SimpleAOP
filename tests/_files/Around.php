<?php

namespace sample;

use AopJoinpoint;
use SimpleAOP\Advice\Around as AroundAdvice;

class Around extends AroundAdvice
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function around(AopJoinpoint $jp)
    {
        if($jp->getMethodName() === 'mirror') {
            $jp->setArguments(array('intercepted'));
        }
        
        $jp->process();
        
        if($jp->getMethodName() === 'mirror') {
            $jp->setReturnedValue($jp->getReturnedValue() . " is overrided");
        }
    }
    
    /**
     * Get the point cut selector
     * @return string
     */
    public function getPointCut()
    {
        return 'sample\Business::mirror()';
    }
}