<?php

namespace SimpleAOP\Advice;

use AopJoinpoint;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractAdvice implements ServiceLocatorAwareInterface, AdviceInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    
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