<?php

namespace SimpleAOP\Aspect;

use AopJoinpoint;
use SimpleAOP\Aspect\Feature\AfterInterceptorInterface;

abstract class After extends AbstractAspect implements AfterInterceptorInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // check custom interceptor
        $method = "after" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($jp));
            return;
        }

        // call generic interceptor
        $this->after($jp);
    }
}
