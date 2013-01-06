<?php

namespace SimpleAOP;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;

class Module implements AutoloaderProviderInterface, BootstrapListenerInterface,
    ServiceProviderInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $serviceLocator = $e->getApplication()->getServiceManager();
        $serviceListener = $serviceLocator->get('ServiceListenerInterface');
        $serviceListener->addServiceManager(
            'AdvicePluginManager',
            'aop_plugins',
            'SimpleAOP\Feature\AopPluginProviderInterface',
            'getAopPluginConfig'
        );
    }
    
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'AdvicePluginManager' => 'SimpleAOP\AdvicePluginManager',
            ),
        );
    }
}
