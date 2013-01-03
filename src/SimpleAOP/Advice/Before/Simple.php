<?php

namespace SimpleAOP\Advice\Before;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\BeforeSimpleInterceptorInterface;
use SimpleAOP\Advice\Feature\JoinPointAwareInterface;

abstract class Simple extends AbstractAdvice implements BeforeSimpleInterceptorInterface, 
    JoinPointAwareInterface
{
    /**
     * @var AopJoinpoint 
     */
    protected $joinPoint;
    
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
        $method = "before" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), $jp->getArguments());
            return $this;
        }
        
        // call generic interceptor
        $args = $this->before($method, $jp->getArguments(), $jp->getObject());
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
    
    /**
     * Get the join point
     * @return AopJoinpoint
     */
    public function getJoinPoint()
    {
        return $this->joinPoint;
    }
    
    /**
     * Set the joint point
     * @param AopJoinpoint $jp
     */
    public function setJoinPoint(AopJoinpoint $jp)
    {
        $this->joinPoint = $jp;
        return $this;
    }
}