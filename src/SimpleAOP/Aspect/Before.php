<?php

namespace SimpleAOP\Aspect;

use AopJoinpoint;
use SimpleAOP\Aspect\Feature\BeforeInterceptorInterface;

abstract class Before extends AbstractAspect implements BeforeInterceptorInterface
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
