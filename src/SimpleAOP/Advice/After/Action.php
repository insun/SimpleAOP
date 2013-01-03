<?php

namespace SimpleAOP\Advice\After;

use AopJoinpoint;
use SimpleAOP\Advice\Feature\AfterActionInterceptorInterface;
use SimpleAOP\Advice\Feature\JoinPointAwareInterface;

abstract class Action extends AbstractAdvice implements AfterActionInterceptorInterface,
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
        $method = "after" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            call_user_func_array(array($this, $method), array($jp->getReturnedValue()));
            return $this;
        }
        
        // call generic interceptor
        $return = $this->after($jp->getReturnedValue());
        if(null != $return) {
            $jp->setReturnedValue($return);
        }
        return $this;
    }
    
    /**
     * After advice in controller
     * @param null|ModelInterface $model
     */
    public function after($model);
    
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