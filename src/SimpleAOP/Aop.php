<?php

namespace SimpleAOP;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Stdlib\Exception;

class Aop implements ServiceLocatorAwareInterface
{
    /**
     * Constants for advice
     */
    const BEFORE = 'before';
    const AFTER = 'after';
    const AROUND = 'around';
    
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;
    
    /**
     * Add an advice with the selector
     * @param string $selector
     * @param \SimpleAOP\Advice\AdviceInterface\string $advice
     */
    public function register($selector, $advice)
    {
        if(!$advice instanceof Advice\AdviceInterface) {
            $advice = $this->getServiceLocator()->get($advice);
        }
        
        if($advice instanceof ServiceLocatorAwareInterface) {
            $advice->setServiceLocator($this->serviceLocator);
        }
        
        switch(true) {
            case ($advice instanceof Advice\Feature\BeforeInterface) :
                aop_add_before($selector, $advice);
                break;
            case ($advice instanceof Advice\Feature\AfterInterface) :
                aop_add_after($selector, $advice);
                break;
            case ($advice instanceof Advice\Feature\AroundInterface) :
                aop_add_around($selector, $advice);
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