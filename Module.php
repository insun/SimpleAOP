<?php

namespace SimpleAOP;

use Zend\EventManager\EventInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ServiceProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;

class Module implements AutoloaderProviderInterface, ServiceProviderInterface,
    BootstrapListenerInterface
{
    public function onBootstrap(EventInterface $e)
    {
        $application = $e->getApplication();
        $serviceLocator = $application->getServiceManager();
        $aop = $serviceLocator->get('aop');
        $config = $serviceLocator->get('Config');
        if(!isset($config['aop'])) {
            return;
        }
        foreach($config['aop'] as $aspect) {
            $aop->register($aspect);
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
