<?php

namespace ModuleTest;

use SimpleAOP\Feature\AopAspectProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AopAspectProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        return array(
            'aop' => array(
                'security_interceptor',
            ),
            'console' => array(
                'router' => array(
                    'routes' => array(
                        'tests' => array(
                            'type' => 'simple',
                            'options' => array(
                                'route' => '--tests',
                                'defaults' => array(
                                    'controller' => 'test_test',
                                    'action'     => 'test',
                                ),
                            ),
                        ),
                    ),
                ),
            ),
            'controllers' => array(
                'invokables' => array(
                    'test_test' => 'ModuleTest\Controller\TestController',
                ),
            ),
        );
    }

    public function getAopAspectConfig()
    {
        return array(
            'invokables' => array(
                'security_interceptor' => 'ModuleTest\Aspect\SecurityInterceptor',
            ),
        );
    }
}
