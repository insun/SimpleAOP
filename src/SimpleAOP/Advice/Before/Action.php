<?php

namespace SimpleAOP\Advice\Before;

use AopJoinpoint;
use SimpleAOP\Advice\AbstractAdvice;
use SimpleAOP\Advice\Feature\BeforeActionInterceptorInterface;
use SimpleAOP\Advice\Feature\JoinPointAwareInterface;
use Zend\Stdlib\Exception;

abstract class Action extends AbstractAdvice implements BeforeActionInterceptorInterface,
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

        // get the application request
        $request = $this->getServiceLocator()->get('Request');
        $event = $controller->getEvent();

        // check custom interceptor
        $method = "before" . ucfirst($jp->getMethodName());
        if(method_exists($this, $method)) {
            $args = call_user_func_array(array($this, $method), array($jp->getMethodName(), $request, $event));
        } else {
            // call generic interceptor
            $args = $this->before($jp->getMethodName(), $request, $event);
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
