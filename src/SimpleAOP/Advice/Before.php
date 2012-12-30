<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\BeforeInterface;

abstract class Before extends AbstractAdvice implements BeforeInterface
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
        $method = "before" . ucfirst($jp->getMethod());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $jp->getArguments());
            return $this;
        }
        
        // call generic interceptor
        $args = $this->before($method, $jp->getArguments());
        if(is_array($args)) {
            $jp->setArguments($args);
        }
        return $this;
    }
    
    /**
     * Before advice
     * @param string $method
     * @param array $arguments
     */
    abstract public function before($method, array $arguments = array());
}