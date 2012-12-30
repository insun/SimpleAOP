<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

abstract class AbstractAdvice implements ServiceLocatorAwareInterface, AdviceInterceptorInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    
    /**
     * @var AopJoinpoint 
     */
    protected $joinPoint;
    
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return AbstractAdvice
     */
    abstract public function __invoke(AopJoinpoint $jp);
    
    /**
     * Get the joint point
     * @return AopJoinpoint
     */
    public function getJoinPoint()
    {
        return $this->joinPoint;
    }
    
    /**
     * Set the joint point
     * @param AopJoinpoint $jp
     * @return \SimpleAOP\Advice\AbstractAdvice
     */
    public function setJoinPoint(AopJoinpoint $jp)
    {
        $this->joinPoint = $jp;
        return $this;
    }
    
    /**
     * Set service locator
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get service locator
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
}