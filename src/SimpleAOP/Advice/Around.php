<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\AroundInterface;

abstract class Around extends AbstractAdvice implements AroundInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return AbstractAdvice
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // save the join point
        $this->setJoinPoint($jp);
        
        // check custom interceptor
        $method = "around" . ucfirst($jp->getMethod());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($jp));
            return $this;
        }
        
        // call generic interceptor
        $this->around($jp);
        return $this;
    }
    
    /**
     * Around advice
     * @param AopJoinpoint $jp
     */
    abstract public function around(AopJoinpoint $jp);
}