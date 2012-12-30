<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\AfterInterface;

abstract class After extends AbstractAdvice implements AfterInterface
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
        $method = "after" . ucfirst($jp->getMethod());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($jp->getReturnedValue()));
            return $this;
        }
        
        // call generic interceptor
        $return = $this->after($jp->getReturnedValue());
        if(null != $return) {
            $jp->setReturnedValue($return);
        }
        return $this;
    }
    
    /**
     * After advice
     * @param mixed $return
     */
    abstract public function after($return);
}