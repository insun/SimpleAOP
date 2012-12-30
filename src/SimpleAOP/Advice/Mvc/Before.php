<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\Mvc\BeforeActionInterface;

abstract class Before extends AbstractAdvice implements BeforeActionInterface
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
        
        // get the application request
        $request = $this->getServiceLocator()->get('Request');
        
        // check custom interceptor
        $method = "before" . ucfirst($jp->getMethod());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $request);
            return $this;
        }
        
        // call generic interceptor
        $this->before($method, $request);
        return $this;
    }
    
    /**
     * Before advice
     * @param RequestInterface $request
     */
    public function before(RequestInterface $request);
}