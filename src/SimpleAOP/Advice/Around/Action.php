<?php

namespace SimpleAOP\Advice\Around;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\AroundActionInterceptorInterface;

abstract class Action extends AbstractAdvice implements AroundActionInterceptorInterface
{
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return AbstractAdvice
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // get the application request
        $request = $this->getServiceLocator()->get('Request');
        
        // check custom interceptor
        $method = "around" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($request, $jp));
            return $this;
        }
        
        // call generic interceptor
        $this->around($request, $jp);
        return $this;
    }
    
    /**
     * Around advice
     * @param RequestInterface $request
     * @param AopJoinpoint $jp
     */
    abstract public function around(RequestInterface $request, AopJoinpoint $jp);
}