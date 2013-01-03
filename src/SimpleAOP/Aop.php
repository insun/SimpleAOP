<?php

namespace SimpleAOP;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Stdlib\Exception;

class Aop implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    
    /**
     * Add an advice with the selector
     * @param \SimpleAOP\Advice\AdviceInterface|string $advice
     */
    public function register($advice)
    {
        // TODO : create a AdvicePluginManager to manager this
        if(is_string($advice)) {
            $advice = $this->getServiceLocator()->get($advice);
        }
        
        if(!$advice instanceof Advice\AdviceInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Advice must be an instance of %s\Advice\AdviceInterface', __NAMESPACE__
            ));
        }
        
        if($advice instanceof ServiceLocatorAwareInterface) {
            $advice->setServiceLocator($this->serviceLocator);
        }
        
        switch(true) {
            case ($advice instanceof Advice\BeforeInterface) :
                aop_add_before($advice->getPointCut(), $advice);
                break;
            case ($advice instanceof Advice\AfterInterface) :
                aop_add_after($advice->getPointCut(), $advice);
                break;
            case ($advice instanceof Advice\AroundInterface) :
                aop_add_around($advice->getPointCut(), $advice);
                break;
            default:
                throw new Exception\InvalidArgumentException(sprintf(
                    'Advice class "%s" is invalid', get_class($advice)
                ));
        }
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