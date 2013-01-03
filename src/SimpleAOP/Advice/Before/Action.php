<?php

namespace SimpleAOP\Advice\Before;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\BeforeActionInterceptorInterface;
use SimpleAOP\Advice\Feature\JoinPointAwareInterface;

abstract class Simple extends AbstractAdvice implements BeforeActionInterceptorInterface,
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
        
        // get the application request
        $request = $this->getServiceLocator()->get('Request');
        
        // check custom interceptor
        $method = "before" . ucfirst($jp->getMethodName());
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