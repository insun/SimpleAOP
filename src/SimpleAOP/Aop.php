<?php

namespace SimpleAOP;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Exception;

class Aop implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var AspectPluginManager
     */
    protected $aspectPluginManager;

    /**
     * Add an aspect with the selector
     * @param \SimpleAOP\Aspect\AspectInterface|string $aspect
     */
    public function register($aspect)
    {
        if(is_string($aspect)) {
            $aspect = $this->getAspectPluginManager()->get($aspect);
        }

        if(!$aspect instanceof Aspect\AspectInterface) {
            throw new Exception\InvalidArgumentException(sprintf(
                'Aspect must be an instance of %s\Aspect\AspectInterface', __NAMESPACE__
            ));
        }

        if($aspect instanceof ServiceLocatorAwareInterface) {
            $aspect->setServiceLocator($this->serviceLocator);
        }

        switch(true) {
            case ($aspect instanceof Aspect\BeforeInterface) :
                $this->registerAspect($aspect, 'aop_add_before');
                break;
            case ($aspect instanceof Aspect\AfterInterface) :
                $this->registerAspect($aspect, 'aop_add_after');
                break;
            case ($aspect instanceof Aspect\AroundInterface) :
                $this->registerAspect($aspect, 'aop_add_around');
                break;
            default:
                throw new Exception\InvalidArgumentException(sprintf(
                    'Aspect class "%s" is invalid', get_class($aspect)
                ));
        }
        return $this;
    }

    /**
     * Register an aspect for a type
     * @param \SimpleAOP\Aspect\AspectInterface $aspect
     * @param string $register
     */
    protected function registerAspect(Aspect\AspectInterface $aspect, $register)
    {
        $pcs = $aspect->getPointCut();
        if(!is_array($pcs)) {
            $pcs = array($pcs);
        }
        foreach($pcs as $pc) {
            call_user_func_array($register, array($pc, $aspect));
        }
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

    /**
     * Get the aspect plugin manager
     * @return AspectPluginManager
     */
    public function getAspectPluginManager()
    {
        if(null === $this->aspectPluginManager) {
            $aspectPluginManager = $this->getServiceLocator()->get('AspectPluginManager');
            $this->setAspectPluginManager($aspectPluginManager);
        }
        return $this->aspectPluginManager;
    }

    /**
     * Set the aspect plugin manager
     * @param \SimpleAOP\AspectPluginManager $aspectPluginManager
     * @return \SimpleAOP\Aop
     */
    public function setAspectPluginManager(AspectPluginManager $aspectPluginManager)
    {
        $this->aspectPluginManager = $aspectPluginManager;
        return $this;
    }
}
