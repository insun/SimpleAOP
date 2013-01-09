<?php

namespace SimpleAOP\Aspect\Around;

use AopJoinpoint;
use SimpleAOP\Aspect\AbstractAspect;
use SimpleAOP\Aspect\Feature\AroundActionInterceptorInterface;
use SimpleAOP\Aspect\Feature\JoinPointAwareInterface;
use Zend\Stdlib\Exception;

abstract class Action extends AbstractAspect implements AroundActionInterceptorInterface,
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
            throw new Exception\InvalidArgumentException('Action advice must be only attached on controller action');
        }

        // save the join point
        $this->setJoinPoint($jp);

        // get the application request
        $request = $this->getServiceLocator()->get('Request');
        $event = $controller->getEvent();

        // check custom interceptor
        $method = "around" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            $return = call_user_func_array(array($this, $method), array($request, $event));
        } else {
            // call generic interceptor
            $return = $this->around($jp->getMethodName(), $request, $event);
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
