<?php

namespace SimpleAOP\Advice\After;

use AopJoinpoint;
use SimpleAOP\Advice\AbstractAdvice;
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
     * @return mixed
     */
    public function __invoke(AopJoinpoint $jp)
    {
        $controller = $jp->getObject();
        if(!preg_match('#Action$#', $jp->getMethodName())) {
            throw Exception\InvalidArgumentException('Action advice must be only attached on controller action');
        }

        // save the join point
        $this->setJoinPoint($jp);

        // check custom interceptor
        $method = "after" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            $return = call_user_func_array(array($this, $method), array($jp->getReturnedValue()));
        } else {
            // call generic interceptor
            $return = $this->after($jp->getReturnedValue());
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
