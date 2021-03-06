<?php

namespace SimpleAOP\Aspect\Before;

use AopJoinpoint;
use SimpleAOP\Aspect\AbstractAspect;
use SimpleAOP\Aspect\Feature\BeforeSimpleInterceptorInterface;
use SimpleAOP\Aspect\Feature\JoinPointAwareInterface;

abstract class Simple extends AbstractAspect implements BeforeSimpleInterceptorInterface,
    JoinPointAwareInterface
{
    /**
     * @var AopJoinpoint
     */
    protected $joinPoint;

    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return mixed
     */
    public function __invoke(AopJoinpoint $jp)
    {
        // save the join point
        $this->setJoinPoint($jp);

        // check custom interceptor
        $method = "before" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            $args = call_user_func_array(array($this, $method), $jp->getArguments());
        } else {
            // call generic interceptor
            $args = $this->before($jp->getMethodName(), $jp->getArguments(), $jp->getObject());
        }
        if(is_array($args)) {
            $jp->setArguments($args);
        }
    }

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
