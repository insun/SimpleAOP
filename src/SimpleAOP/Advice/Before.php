<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\BeforeInterceptorInterface;

abstract class Before extends AbstractAdvice implements BeforeInterceptorInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // check custom interceptor
        $method = "before" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $jp);
            return;
        }
        
        // call generic interceptor
        $this->before($jp);
    }
}