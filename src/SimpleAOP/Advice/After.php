<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\AfterInterceptorInterface;

abstract class After extends AbstractAdvice implements AfterInterceptorInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return AbstractAdvice
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // check custom interceptor
        $method = "after" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($jp));
            return $this;
        }
        
        // call generic interceptor
        $this->after($jp);
        return $this;
    }
    
    /**
     * After advice
     * @param AopJoinpoint $jp
     */
    abstract public function after(AopJoinpoint $jp);
    
    /**
     * Get the point cut selector
     * @return string
     */
    abstract public function getPointCut();
}