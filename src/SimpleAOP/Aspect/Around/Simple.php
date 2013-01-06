<?php

namespace SimpleAOP\Aspect\Around;

use AopJoinpoint;
use SimpleAOP\Aspect\AbstractAspect;
use SimpleAOP\Aspect\Feature\AroundSimpleInterceptorInterface;
use SimpleAOP\Aspect\Feature\JoinPointAwareInterface;

abstract class Simple extends AbstractAspect implements AroundSimpleInterceptorInterface,
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
        $method = "around" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            $return = call_user_func_array(array($this, $method), $jp->getArguments());
        } else {
            // call generic interceptor
            $return = $this->around($jp->getMethodName(), $jp->getArguments(), $jp->getObject());
        }
        if(null != $return) {
            $jp->setReturnedValue($return);
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
