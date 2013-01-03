<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\BeforeInterceptorInterface;

abstract class Before extends AbstractAdvice implements BeforeInterceptorInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return AbstractAdvice
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // check custom interceptor
        $method = "before" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $jp);
            return $this;
        }
        
        // call generic interceptor
        $this->before($jp);
        return $this;
    }
    
    /**
     * Before advice
     * @param AopJoinpoint $jp
     */
    abstract public function before(AopJoinpoint $jp);
    
    /**
     * Get the point cut selector
     * @return string
     */
    abstract public function getPointCut();
}