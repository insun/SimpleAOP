<?php

namespace SimpleAOP;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ServiceManager\Config;

class Module implements AutoloaderProviderInterface, ServiceProviderInterface,
    BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $application = $e->getApplication();
        $serviceLocator = $application->getServiceManager();
        $aop = $serviceLocator->get('aop');
        $configuration = $serviceLocator->get('Config');
        if(!isset($configuration['aop'])) {
            return;
        }
        $aspectPluginManager = $serviceLocator->get('AspectPluginManager');
        $config = new Config($configuration['aop']);
        $config->configureServiceManager($aspectPluginManager);
        
        foreach($aspectPluginManager->getRegisteredServices() as $services) {
            foreach($services as $aspect) {
                $aop->register($aspect);
            }
        }
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
                'simple_aop' => 'SimpleAOP\Aop',
            ),
            'aliases' => array(
                'aop' => 'simple_aop',
            ),
        );
    }
}
