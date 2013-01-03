<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

abstract class AbstractAdvice implements ServiceLocatorAwareInterface, AdviceInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    
    /**
     * Advice callback
     * @param AopJoinpoint $jp
     * @return AbstractAdvice
     */
    abstract public function __invoke(AopJoinpoint $jp);
    
    /**
     * Get the point cut selector
     * @return string
     */
    abstract public function getPointCut();
        
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