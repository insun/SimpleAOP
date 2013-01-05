<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\AroundInterceptorInterface;

abstract class Around extends AbstractAdvice implements AroundInterceptorInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // check custom interceptor
        $method = "around" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($jp));
            return;
        }
        
        // call generic interceptor
        $this->around($jp);
    }
}